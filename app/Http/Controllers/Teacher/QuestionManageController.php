<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Quiz;
use App\Course;
use App\Question;

class QuestionManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware('role:teacher');
     }

    public function index($id)
    {
      $course = Course::find($id);
      $quizs = Quiz::where('course_id',$id)->get();



      $data['quizs'] = $quizs;
      $data['course'] = $course;
      return view('teachers.users.questionSelect', $data);
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
      // $question = new Question();
      //
      //
      //   $answer[0]['text'] = 'AAAA';
      //   $answer[0]['type'] = 'true';
      //
      //   $answer[1]['text'] = 'BBBB';
      //   $answer[1]['type'] = 'false';
      //
      //   $answer[2]['text'] = 'CCCC';
      //   $answer[2]['type'] = 'false';
      //
      // $qt['question'] = 'ABCDEADASDDASDASDL AS:DASD"AS :D"ASD:"AS:D"';
      // $qt['answer'] = $answer;
      //
      // dd($qt);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::find($id);
        $course = Course::find($quiz->course_id);
        $questions = Question::where('quiz_id', $id)->get();

        foreach ($questions as $key => $question) {
          $question->descript = unserialize($question->descript);
        }


        $data['quiz'] = $quiz;
        $data['course'] = $course;
        $data['questions'] = $questions;
        $data['choices'] = ['A', 'B', 'C', 'D'];
        return view('teachers.users.questionCreate', $data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $id = $question->quiz_id;
        $question->forceDelete();

        return redirect('/teacher/quiz/question/'.$id)->with([
          'flash_notice' =>'System: ดำเนินการลบข้อมูล สำเร็จ',
           'flash_type' => 'success ']);
    }


    public function trueStore(Request $request, $id)
    {

      $question = new Question();

      if ($request->hasFile('image') && $request->file('image')->isValid()) {

        $image= array('image' => $request['image']);
        // Tell the validator that this file should be an image
        $rules = array(
          'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        );

        // Now pass the input and rules into the validator
        $validator = Validator::make($image, $rules);

        if ($validator->fails()){
          return redirect('/teacher/quiz/question/'.$id)->with([
            'flash_notice' =>'System: เกิดข้อผิดพลาด File type: jpeg,jpg,png,gif,  Maximum: 10000kb',
             'flash_type' => 'danger ']);
        }else{
          $time = intval(microtime(true)*1000);

          $path = $request->file('image')->getRealPath();
          $mime_type = $request->file('image')->getClientOriginalExtension();
          $destination_path = 'image/' . 'quiz'.$id.'/'. $time . '.' . $mime_type;
          \Storage::put($destination_path, file_get_contents($path));

          $question->image = $destination_path;
        }

      }else{
        $question->image = '';
      }

      $descript['ask'] = $request['ask'];
      $descript['type'] = 'trueOrfalse';
      $descript['answer'] = $request['answer'];

      $question->quiz_id = $id;
      $question->descript = serialize($descript);
      $question->answer = serialize($request['answer']);

      $question->save();


      return redirect('/teacher/quiz/question/'.$id)->with([
        'flash_notice' =>'System: ดำเนินการเพิ่มข้อมูล สำเร็จ',
         'flash_type' => 'success ']);


    }

    public function trueUpdate(Request $request, $id)
    {


      $question = Question::find($id);
      $id = $question->quiz_id;


      if ($request->hasFile('image') && $request->file('image')->isValid()) {

        $image= array('image' => $request['image']);
        // Tell the validator that this file should be an image
        $rules = array(
          'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        );

        // Now pass the input and rules into the validator
        $validator = Validator::make($image, $rules);

        if ($validator->fails()){
          return redirect('/teacher/quiz/question/'.$id)->with([
            'flash_notice' =>'System: เกิดข้อผิดพลาด File type: jpeg,jpg,png,gif,  Maximum: 10000kb',
             'flash_type' => 'danger ']);
        }else{
          $time = intval(microtime(true)*1000);

          $path = $request->file('image')->getRealPath();
          $mime_type = $request->file('image')->getClientOriginalExtension();
          $destination_path = 'image/' . 'quiz'.$id.'/'. $time . '.' . $mime_type;
          \Storage::put($destination_path, file_get_contents($path));

          $question->image = $destination_path;
        }

      }else if($request['delete'] == "delete"){
          $question->image = '';
      }


      $descript['ask'] = $request['ask'];
      $descript['type'] = 'trueOrfalse';
      $descript['answer'] = $request['answer'];


      $question->descript = serialize($descript);
      $question->answer = serialize($request['answer']);

      $question->save();

      return redirect('/teacher/quiz/question/'.$id)->with([
        'flash_notice' =>'System: ดำเนินการแก้ไขข้อมูล สำเร็จ',
         'flash_type' => 'success ']);



    }


    public function fourStore(Request $request, $id)
    {


      $question = new Question();

      if ($request->hasFile('image') && $request->file('image')->isValid()) {

        $image= array('image' => $request['image']);
        // Tell the validator that this file should be an image
        $rules = array(
          'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        );

        // Now pass the input and rules into the validator
        $validator = Validator::make($image, $rules);

        if ($validator->fails()){
          return redirect('/teacher/quiz/question/'.$id)->with([
            'flash_notice' =>'System: เกิดข้อผิดพลาด File type: jpeg,jpg,png,gif,  Maximum: 10000kb',
             'flash_type' => 'danger ']);
        }else{
          $time = intval(microtime(true)*1000);

          $path = $request->file('image')->getRealPath();
          $mime_type = $request->file('image')->getClientOriginalExtension();
          $destination_path = 'image/' . 'quiz'.$id.'/'. $time . '.' . $mime_type;
          \Storage::put($destination_path, file_get_contents($path));

          $question->image = $destination_path;
        }

      }else{
        $question->image = '';
      }

      $descript['ask'] = $request['ask'];
      $descript['type'] = 'fourChoice';
      $descript['answer'] = $request['answer'];
      $descript['answerRadio'] = $request['answerRadio'];

      $question->quiz_id = $id;
      $question->descript = serialize($descript);
      $question->answer = serialize($request['answerRadio']);

      $question->save();


      return redirect('/teacher/quiz/question/'.$id)->with([
        'flash_notice' =>'System: ดำเนินการเพิ่มข้อมูล สำเร็จ',
         'flash_type' => 'success ']);


    }

    public function fourUpdate(Request $request, $id)
    {


      $question = Question::find($id);
      $id = $question->quiz_id;


      if ($request->hasFile('image') && $request->file('image')->isValid()) {

        $image= array('image' => $request['image']);
        // Tell the validator that this file should be an image
        $rules = array(
          'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        );

        // Now pass the input and rules into the validator
        $validator = Validator::make($image, $rules);

        if ($validator->fails()){
          return redirect('/teacher/quiz/question/'.$id)->with([
            'flash_notice' =>'System: เกิดข้อผิดพลาด File type: jpeg,jpg,png,gif,  Maximum: 10000kb',
             'flash_type' => 'danger ']);
        }else{
          $time = intval(microtime(true)*1000);

          $path = $request->file('image')->getRealPath();
          $mime_type = $request->file('image')->getClientOriginalExtension();
          $destination_path = 'image/' . 'quiz'.$id.'/'. $time . '.' . $mime_type;
          \Storage::put($destination_path, file_get_contents($path));

          $question->image = $destination_path;
        }

      }else if($request['delete'] == "delete"){
          $question->image = '';
      }



      $descript['ask'] = $request['ask'];
      $descript['type'] = 'fourChoice';
      $descript['answer'] = $request['answer'];
      $descript['answerRadio'] = $request['answerRadio'];


      $question->descript = serialize($descript);
      $question->answer = serialize($request['answerRadio']);

      $question->save();

      return redirect('/teacher/quiz/question/'.$id)->with([
        'flash_notice' =>'System: ดำเนินการแก้ไขข้อมูล สำเร็จ',
         'flash_type' => 'success ']);



    }

    public function wordStore(Request $request, $id)
    {


      $question = new Question();

      if ($request->hasFile('image') && $request->file('image')->isValid()) {

        $image= array('image' => $request['image']);
        // Tell the validator that this file should be an image
        $rules = array(
          'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        );

        // Now pass the input and rules into the validator
        $validator = Validator::make($image, $rules);

        if ($validator->fails()){
          return redirect('/teacher/quiz/question/'.$id)->with([
            'flash_notice' =>'System: เกิดข้อผิดพลาด File type: jpeg,jpg,png,gif,  Maximum: 10000kb',
             'flash_type' => 'danger ']);
        }else{
          $time = intval(microtime(true)*1000);

          $path = $request->file('image')->getRealPath();
          $mime_type = $request->file('image')->getClientOriginalExtension();
          $destination_path = 'image/' . 'quiz'.$id.'/'. $time . '.' . $mime_type;
          \Storage::put($destination_path, file_get_contents($path));

          $question->image = $destination_path;
        }

      }else{
        $question->image = '';
      }

      $descript['ask'] = $request['ask'];
      $descript['type'] = 'word';
      $descript['answer'] = $request['answer'];

      $question->quiz_id = $id;
      $question->descript = serialize($descript);
      $question->answer = serialize($request['answer']);

      $question->save();


      return redirect('/teacher/quiz/question/'.$id)->with([
        'flash_notice' =>'System: ดำเนินการเพิ่มข้อมูล สำเร็จ',
         'flash_type' => 'success ']);


    }

    public function wordUpdate(Request $request, $id)
    {


      $question = Question::find($id);
      $id = $question->quiz_id;


      if ($request->hasFile('image') && $request->file('image')->isValid()) {

        $image= array('image' => $request['image']);
        // Tell the validator that this file should be an image
        $rules = array(
          'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        );

        // Now pass the input and rules into the validator
        $validator = Validator::make($image, $rules);

        if ($validator->fails()){
          return redirect('/teacher/quiz/question/'.$id)->with([
            'flash_notice' =>'System: เกิดข้อผิดพลาด File type: jpeg,jpg,png,gif,  Maximum: 10000kb',
             'flash_type' => 'danger ']);
        }else{
          $time = intval(microtime(true)*1000);

          $path = $request->file('image')->getRealPath();
          $mime_type = $request->file('image')->getClientOriginalExtension();
          $destination_path = 'image/' . 'quiz'.$id.'/'. $time . '.' . $mime_type;
          \Storage::put($destination_path, file_get_contents($path));

          $question->image = $destination_path;
        }

      }else if($request['delete'] == "delete"){
          $question->image = '';
      }



      $descript['ask'] = $request['ask'];
      $descript['type'] = 'word';
      $descript['answer'] = $request['answer'];


      $question->descript = serialize($descript);
      $question->answer = serialize($request['answer']);

      $question->save();

      return redirect('/teacher/quiz/question/'.$id)->with([
        'flash_notice' =>'System: ดำเนินการแก้ไขข้อมูล สำเร็จ',
         'flash_type' => 'success ']);



    }
}
