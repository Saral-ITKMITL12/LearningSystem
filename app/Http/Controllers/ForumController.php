<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Auth;
use App\Course;
use App\User;

use Pusher;
class ForumController extends Controller
{
  // public function __construct()
  // {
  //     $this->middleware('auth');
  // }

  public function index($id)
  {
    $user = Auth::user();
    $user_id = $user->id;

    $courses = Course::all();

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

    $userCourse = Course::whereIn('id',$teach_c)->get();
    $data['courses'] = $userCourse;
    return view('forum.showForum', $data);
  }

  public function storeMessage(Request $request, $id)
  {
    $course = Course::find($id);


    $data['course'] = $course;
    $data['message'] = $request['message'];


    return \Response::json(view('forum.messageTeacher', $data)->render());
  }



}
