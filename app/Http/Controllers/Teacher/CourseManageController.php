<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Course;
use App\User;

class CourseManageController extends Controller
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

    public function __construct()
    {
       $this->middleware('role:teacher');
    }

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
      $course = Course::find($id);
      $members = unserialize($course->member);

      $count = collect($members)->count();

      $users = $request['student'];

      foreach ($users as $key => $user) {
          $members[$count+$key] = (int)$request['student'][$key];
      }


      $course->member = serialize($members);

      $course->save();

      return redirect('/teacher/user/userCouseManage/'.$id)->with([
        'flash_notice' =>'System: ดำเนินการแก้ไขข้อมูล สำเร็จ',
         'flash_type' => 'success ']);
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

    public function intoCourse($id)
    {
      $course = Course::find($id);

      $data['course'] = $course;
      $data['id'] = $id;

      return view('teachers.users.intoCourseMenu', $data);
    }

    public function userCouseManage($id)
    {
      $course = Course::find($id);
      $members = unserialize($course->member);
      $tchMembers= unserialize($course->teach_id);

      $user = User::whereIn('stud_id', $members)->orWhereIn('id', $tchMembers)->paginate(10);

      $userSearch = User::whereHas('roles', function ($query) {
                 $query->where('name', '=', 'student');
      })->whereNotIn('stud_id', $members)->get();


      $data['users'] = $user;
      $data['userSearch'] = $userSearch;
      $data['course'] = $course;
      $data['id'] = $id;

      return view('teachers.users.userCourseManage', $data);
    }


    public function courseMemberPaginate($id)
    {

      $course = Course::find($id);
      $members = unserialize($course->member);

      $user = User::whereIn('stud_id', $members)->paginate(10);

      $data['users'] = $user;
      $data['course'] = $course;

      return \Response::json(view('teachers.list.courseUserList', $data)->render());

    }

}
