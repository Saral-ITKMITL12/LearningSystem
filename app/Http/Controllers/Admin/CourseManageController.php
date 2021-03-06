<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Course;
use App\User;
use App\Role;
use Excel;

class CourseManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware('role:admin');
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
      $teachers = User::whereHas('roles', function ($query) {
                 $query->where('name', '=', 'teacher');
      })->get();


      $class = ['1','2','3','34','4'];
      $courses = [];
      $teacherData = [];
      foreach ($class as $key => $value) {
        $count = Course::where('class', '=', $value)->count();
        if($count>0){
          $courses[$value] = Course::where('class', '=', $value)->get();

          foreach ($courses[$value] as $ckey => $course){
            $mem_teachs = unserialize($course->teach_id);


            foreach ($mem_teachs as $mkey => $mem_teach){
              $user = User::find($mem_teach);
              $teacherData[$value][$ckey][$mkey][0] = [$user->first_name];
              $teacherData[$value][$ckey][$mkey][1] = [$user->last_name];
              $teacherData[$value][$ckey][$mkey][2] = [$user->email];

            }

          }

        }
      }
      // dd($teacherData[1][0][1][0][0]);
      $data['courses'] = $courses;
      $data['teachers'] = $teachers;
      $data['teacherData'] = $teacherData;
      return view('admins.users.course' , $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = new Course();
        $course->code = $request['code'];
        $course->name = $request['name'];
        $course->class = $request['class'];
        $course->descript = $request['descript'];


        $course->teach_id = serialize($request['teacher']);


        if($request->hasFile('import_file')){
          $path = $request['import_file']->getRealPath();
          $data = Excel::load($path, function($reader) {})->get();
            $memberArray = array();
            foreach ($data as $key => $value){
              $memberArray[$key] = (int)$value->stud_id;
            }
            // dd($member);
            $course->member = serialize($memberArray);
          $course->save();

          return redirect('admin/user/course/create')->with([
            'flash_notice' =>'System: ดำเนินการเพิ่มข้อมูล สำเร็จ',
             'flash_type' => 'success ']);
        }else{
            return redirect('admin/user/course/create')->with([
              'flash_notice' =>'System: เกิดข้อผิดพลาด กรุณาเลือกไฟล์เพื่อดำเนินการต่อ',
               'flash_type' => 'danger ']);
        }



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

        return redirect('/admin/courseMember/'.$id)->with([
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

    public function courseMember($id)
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

        return view('admins.users.courseUser', $data);
    }

    public function courseMemberPaginate($id)
    {

      $course = Course::find($id);
      $members = unserialize($course->member);
      $tchMembers= unserialize($course->teach_id);

      $user = User::whereIn('stud_id', $members)->orWhereIn('id', $tchMembers)->paginate(10);

      $data['users'] = $user;
      $data['course'] = $course;

      return \Response::json(view('admins.list.courseUserList', $data)->render());

    }


}
