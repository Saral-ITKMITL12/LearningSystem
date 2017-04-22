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
    $course = Course::find($id);


    $data['course'] = $course;
    return view('forum.showForum', $data);
  }



}
