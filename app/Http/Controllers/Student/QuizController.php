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
use Carbon\Carbon;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $now = Carbon::now();
        $quizs = Quiz::where([['course_id', $id], ['start_date', '<', $now],  ['expire_date', '>', $now]])->get();
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
      $quiz = Quiz::find($id);
      $paginates = Question::where('quiz_id', $id)->paginate(1);
      $questions = Question::where('quiz_id', $id)->get();

      $user_id = Auth::user()->id;

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
}
