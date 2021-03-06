<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Card;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();

      if($user->hasRole('admin')){
          return view('admins.users.home');
      }else if($user->hasRole('teacher')){
          return redirect('/teacher/user/course/create');
      }else{
          return redirect('/student/user/course/create');
      }

    }
}
