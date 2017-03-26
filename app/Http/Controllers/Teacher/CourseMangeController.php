<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Course;

class CourseMangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //  public function __construct()
    //  {
    //     $this->middleware('role:teacher');
    //  }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        return view('teachers.users.home', $data);
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
        //
    }

}
