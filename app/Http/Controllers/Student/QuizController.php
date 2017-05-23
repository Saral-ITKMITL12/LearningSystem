<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Auth;
use App\Course;
use App\User;
use App\Quiz;
use App\Question;
use App\Response;
use App\Finish;
use Carbon\Carbon;
use Pusher;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $quizs = Quiz::where('course_id', $id)->get();
        if($quizs->count() == 0){
          return back()->with([
            'flash_notice' =>'System: ยังไม่มีแบบทดสอบในขณะนี้',
             'flash_type' => 'warning ']);
        }

        $quizID_list;
        foreach ($quizs as $key => $quiz_value) {

          $date = $quiz_value->start_date;
          $splitDateTime = explode('/', $date);
          $splitDate = preg_split('/\s+/', $splitDateTime[2]);
          $time  = explode(':', $splitDate[1]);
          $day = $splitDateTime[0];
          $month = $splitDateTime[1];
          $year = $splitDate[0];
          $time = $splitDate[1];
          $hour = $time[0].$time[0];
          $minute = $time[3].$time[4];
          $dateTime = $day.'-'.$month.'-'.$year.' '.$time;
          $quizStartDateTime = Carbon::create($year, $month, $day, 10, $minute, 0, 'Asia/Bangkok');


          $date = $quiz_value->expire_date;
          $splitDateTime = explode('/', $date);
          $splitDate = preg_split('/\s+/', $splitDateTime[2]);
          $time  = explode(':', $splitDate[1]);
          $day = $splitDateTime[0];
          $month = $splitDateTime[1];
          $year = $splitDate[0];
          $time = $splitDate[1];
          $hour = $time[0].$time[0];
          $minute = $time[3].$time[4];
          $dateTime = $day.'-'.$month.'-'.$year.' '.$time;
          $quizExpireDateTime = Carbon::create($year, $month, $day, 10, $minute, 0, 'Asia/Bangkok');

          $now =  Carbon::now('Asia/Bangkok');
          //$now->gte($quizExpireDateTime)

          if($now->gte($quizStartDateTime) && $now->lte($quizExpireDateTime))
          $quizID_list[] = $quiz_value->id;


        }


        $quizs = Quiz::whereIn('id', $quizID_list)->get();

        if($quizs->count() == 0){
          return back()->with([
            'flash_notice' =>'System: ยังไม่มีแบบทดสอบในขณะนี้',
             'flash_type' => 'warning ']);
        }
        // $date = $quizs[0]->start_date;
        // $splitDateTime = explode('/', $date);
        // $splitDate = preg_split('/\s+/', $date);
        // //$now = Carbon::createFromFormat('Y-m-d H', '1975-05-21 22')->toDateTimeString();
        // dd($splitName);

        $data['quizs'] = $quizs;
        return view('students.users.quizIndex', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      // return \Response::json(view('admins.list.manageUserList')->render());

      // return redirect('admin/user/manage/create')->with([
      //   'flash_notice' =>'System: ดำเนินการกู้ข้อมูล สำเร็จ',
      //    'flash_type' => 'success ']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function doQuiz($id)
    {
      $user_id = Auth::user()->id;
      $finish = Finish::where([['user_id',$user_id],['quiz_id',$id]])->get();
      if($finish->count() != 0){
        return back()->with
        (['flash_notice' =>'System: คุณทำการส่งคำตอบแล้ว ไม่สามารถแก้ไขได้',
        'flash_type' => 'danger']);
      }

      $quiz = Quiz::find($id);
      $paginates = Question::where('quiz_id', $id)->paginate(1);
      $questions = Question::where('quiz_id', $id)->get();

      if($questions->count() == 0){
        return back()->with
        (['flash_notice' =>'System: ผู้สอนยังไม่ได้เพิ่มคำถาม',
        'flash_type' => 'warning']);
      }


      foreach ($paginates as $key => $paginate) {
        $paginate->descript = unserialize($paginate->descript);
      }

      $response = Response::where([['user_id',$user_id],['quiz_id',$id]])->get();
      $resAry = '';
      $resArray ='';
      foreach ($response as $key => $value) {
          $resAry[] = $value->question_id;
          $resArray[$key]['id'] = $value->question_id;
          $resArray[$key]['answer'] = $value->answer;
      }

      $data['quiz'] = $quiz;
      $data['questions'] = $questions;
      $data['paginates'] = $paginates;
      $data['choices'] = ['A', 'B', 'C', 'D'];
      $data['resArray'] = $resArray;
      $data['resAry'] = $resAry;
      $data['quiz_id'] = $id;


      return view('students.users.doQuiz', $data);
    }


    public function quizUpdate(Request $request, $id)
    {
      $user_id = Auth::user()->id;
      $quiz_id = Question::find($id)->quiz_id;
      $page = (int)($request['page']);


      $response = Response::where([['user_id',$user_id],['quiz_id',$quiz_id],['question_id',$id]])->first();

      if(empty($response)){
        $response = new Response();
        $response->user_id = $user_id;
        $response->quiz_id = $quiz_id;
        $response->question_id = $id;
        $response->answer = $request['answer'];

      }else{
        $response->answer = $request['answer'];

      }
      $response->save();


      $options = array(
        'cluster' => 'ap1',
        'encrypted' => true
      );
      $pusher = new Pusher(
        '7435ecf02992f7d22974',
        '6579f55fb7f4a05f5da9',
        '328492',
        $options
      );

      $data['message'] = 'update';
      $pusher->trigger('my-channel', 'update-score', $data);

      return \Response::json(view('layouts.QuizFlashJS',
      ['flash_notice' =>'System: ดำเนินการบันทึกข้อมูล สำเร็จ',
      'flash_type' => 'success'])->render());

    }

    public function quizUpdateFail()
    {

      return \Response::json(view('layouts.flashJS',
      ['flash_notice' =>'System: ไม่สามารถดำเนินการบันทึกข้อมูลได้ กรุณาเลือกคำตอบ',
      'flash_type' => 'danger'])->render());

    }


    public function doQuizPage($id)
    {
      $quiz = Quiz::find($id);
      $paginates = Question::where('quiz_id', $id)->paginate(1);
      $questions = Question::where('quiz_id', $id)->get();

      $user_id = Auth::user()->id;

      foreach ($paginates as $key => $paginate) {
        $paginate->descript = unserialize($paginate->descript);
      }

      $response = Response::where([['user_id',$user_id],['quiz_id',$id]])->get();

      if($response->count() > 0){
        foreach ($response as $key => $value) {
          $resAry[] = $value->question_id;
          $resArray[$key]['id'] = $value->question_id;
          $resArray[$key]['answer'] = $value->answer;
        }

        //dd($resArray);
        $data['resArray'] = $resArray;
        $data['resAry'] = $resAry;
      }

      $data['quiz'] = $quiz;
      $data['questions'] = $questions;
      $data['paginates'] = $paginates;
      $data['choices'] = ['A', 'B', 'C', 'D'];
      $data['quiz_id'] = $id;

      return \Response::json(view('students.list.questionPage', $data)->render());
    }


    public function doQuizPageHead($id)
    {
      $quiz = Quiz::find($id);
      $paginates = Question::where('quiz_id', $id)->paginate(1);
      $questions = Question::where('quiz_id', $id)->get();

      $user_id = Auth::user()->id;

      foreach ($paginates as $key => $paginate) {
        $paginate->descript = unserialize($paginate->descript);
      }

      $response = Response::where([['user_id',$user_id],['quiz_id',$id]])->get();


      foreach ($response as $key => $value) {
          $resAry[] = $value->question_id;
          $resArray[$key]['id'] = $value->question_id;
          $resArray[$key]['answer'] = $value->answer;
      }

      $data['quiz'] = $quiz;
      $data['questions'] = $questions;
      $data['paginates'] = $paginates;
      $data['choices'] = ['A', 'B', 'C', 'D'];
      $data['resArray'] = $resArray;
      $data['resAry'] = $resAry;
      $data['quiz_id'] = $id;


      return \Response::json(view('students.list.paginateHead', $data)->render());
    }

    public function quizFininsh($id)
    {

      $course = Quiz::find($id);

      // check user score
      $myResponses = Response::where([['user_id', Auth::user()->id], ['quiz_id', $id]])->get();
      $myScore = 0;
        foreach ($myResponses as $response_key => $response_value) {
          if($response_value->answer == unserialize(Question::where('id', $response_value->question_id)->first()->answer )){
            $myScore++;
          }
        }

      $finish = new Finish();
      $finish->user_id = Auth::user()->id;
      $finish->quiz_id = $id;
      $finish->course_id = $course->course_id;
      $finish->score = $myScore;
      $finish->save();

      return redirect('/student/user/course/create')->with
      (['flash_notice' =>'System: ดำเนินการส่งคำตอบ สำเร็จ',
      'flash_type' => 'success']);

    }

    public function quizScoreResult($id)
    {
      $user_id = Auth::user()->id;

      $myFinishs = Finish::where('user_id',$user_id)->get();
      if($myFinishs->count() == 0){
        return redirect('/student/user/course/create')->with
        (['flash_notice' =>'System: กรุณาส่งคำตอบก่อน',
        'flash_type' => 'danger']);
      }

      $finishs = Finish::where([['course_id',$id]])->get()->groupBy('quiz_id');

      foreach ($finishs as $key => $finish_value) {
        $quizScore[$key]['count'] = Question::where('quiz_id', $key)->count();
        $quizScore[$key]['max'] = $finish_value->max('score');
        $quizScore[$key]['min'] = $finish_value->min('score');
        $quizScore[$key]['average'] = (int)$finish_value->sum('score') / (int)$finishs->count();;
      }

      $data['course'] = Course::find($id);
      $data['quiz'] = Quiz::where('course_id', $id)->get();
      $data['myFinishs'] = $myFinishs;
      $data['quizScores'] = $quizScore;

      return view('students.users.scoreResult', $data);


    }

}
