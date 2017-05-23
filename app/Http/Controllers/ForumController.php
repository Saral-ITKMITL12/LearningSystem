<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Auth;
use App\Course;
use App\User;
use Pusher;
use App\Forum;

class ForumController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index($id)
  {
    $courses = Course::all();
    $user = Auth::user();

    $user_id = $user->id;
    $teach_c = [];

    foreach ($courses as $ckey => $course) {
       $teachers = unserialize($course->teach_id);

       foreach ($teachers as $tkey => $teacher) {
          if($teacher == $user_id){
            $tc_count = count($teach_c);
            $teach_c[$tc_count] = $course->id;


          }
       }
    }


    $user_id = $user->stud_id;
    $student_c = [];

    foreach ($courses as $ckey => $course) {
       $students = unserialize($course->member);

       foreach ($students as $tkey => $student) {
          if($student == $user_id){
            $std_count = count($student_c);
            $student_c[$std_count] = $course->id;


          }
       }
    }

    $studentCourse = Course::whereIn('id',$student_c)->get();
    $teacherCourse = Course::whereIn('id',$teach_c)->get();


    $message = Forum::where('course_id', $id)->get();

    $data['message'] = $message;
    $data['course_id'] = $id;
    $data['thisCourse'] = Course::find($id);

    if(Auth::user()->hasRole('teacher')){
      $data['courses'] = $teacherCourse;
      return view('forum.showForumTeacher', $data);
    }else if(Auth::user()->hasRole('student')){
      $data['courses'] = $studentCourse;
      return view('forum.showForumStudent', $data);
    }
  }

  public function storeMessage(Request $request, $id)
  {
    $course = Course::find($id);

    $message = new Forum();
    $message->course_id = $id;
    if(Auth::user()->hasRole('teacher')){
      $message->user_type = 'teacher';
      $data['type'] = 'teacher';
      $data['teacher_name'] =  Auth::user()->first_name;
    }else if(Auth::user()->hasRole('student')){
      $message->user_type = 'student';
      $data['type'] = 'student';
    }
    $message->message = $request['message'];
    $message->image = '';
    $message->user_id = Auth::user()->id;
    $message->user_name = Auth::user()->first_name;
    $message->save();


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

    $data['course'] = $course;
    $data['course_id'] = $id;
    $data['message'] =$request['message'];
    $pusher->trigger('my-channel', 'message', $data);

    return \Response::json(view('forum.messageTeacher', $data)->render());
  }



}
