<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Excel;
use App\User;
use App\Role;


class UserManageController extends Controller
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

    public function create()
    {
        $users = User::paginate(5);
        $data['users'] = $users;

        $students = User::whereHas('roles', function ($query) {
                   $query->where('name', '=', 'student');
        })->paginate(5);
        $data['students'] = $students;

        $teachers = User::whereHas('roles', function ($query) {
                   $query->where('name', '=', 'teacher');
        })->paginate(5);
        $data['teachers'] = $teachers;

        $admins = User::whereHas('roles', function ($query) {
                   $query->where('name', '=', 'admin');
        })->paginate(5);
        $data['admins'] = $admins;

        $trashs = User::onlyTrashed()->paginate(5);
        $data['trashs'] = $trashs;

        return view('admins.users.home', $data);
    }

    public function softDelete($id)
    {
      $user = User::find($id);
      $user->delete();
      return redirect('admin/user/manage/create')->with('flash_notice','ดำเนินการลบข้อมูล สำเร็จ ข้อมูลจะถูกสำรองไว้ที่ Trash');
    }
    public function destroy($id)
    {
      $user = User::find($id);
      $user->forceDelete();
      return redirect('admin/user/manage/create')->with('flash_notice','ดำเนินการลบข้อมูล สำเร็จ');
    }

    public function restore($id)
    {
      dd('restore');
      $user = User::onlyTrashed($id);
      $user->restore();
      return redirect('admin/user/manage/create')->with('flash_notice','ดำเนินการกู้ข้อมูล สำเร็จ');
    }

    public function importStdExcel(Request $request)
    {
      if($request->hasFile('import_file')){
        $path = $request['import_file']->getRealPath();
        $data = Excel::load($path, function($reader) {})->get();
          if(!empty($data) && $data->count()){
            foreach ($data as $key => $value) {
              $std = new User();
              $std->first_name = $value->first_name;
              $std->last_name = $value->last_name;
              $std->email = $value->email;
              $std->password = bcrypt($value->password);
              $std->save();

              $std_role = Role::find(3);
              $std->attachRole($std_role);
            }
          }
          return redirect('admin/user/manage/create')->with('flash_notice','ดำเนินการนำเข้าข้อมูลนักศึกษา สำเร็จ');
        }
        return redirect('admin/user/manage/create')->with('flash_fail','เกิดข้อผิดพลาด กรุณาเลือกไฟล์ก่อนทำรายการ');
      }

      public function importTeachExcel(Request $request)
      {
        if($request->hasFile('import_file')){
          $path = $request['import_file']->getRealPath();
          $data = Excel::load($path, function($reader) {})->get();
            if(!empty($data) && $data->count()){
              foreach ($data as $key => $value) {
                $teacher = new User();
                $teacher->first_name = $value->first_name;
                $teacher->last_name = $value->last_name;
                $teacher->email = $value->email;
                $teacher->password = bcrypt($value->password);
                $teacher->save();

                $tch_role = Role::find(2);
                $teacher->attachRole($tch_role);
              }
            }
            return redirect('admin/user/manage/create')->with('flash_notice','ดำเนินการนำเข้าข้อมูลผู้สอน สำเร็จ');
          }
          return redirect('admin/user/manage/create')->with('flash_fail','เกิดข้อผิดพลาด กรุณาเลือกไฟล์ก่อนทำรายการ');
        }

        public function newUser(Request $request)
        {
          $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
          ]);

          $user = new User();
          $user->first_name = $request['first_name'];
          $user->last_name = $request['last_name'];
          $user->email = $request['email'];
          $user->password = bcrypt($request['password']);
          $user->save();

          if($request['role']!=3){
            $user_role = Role::find($request['role']);
            $user->attachRole($user_role);
          }

          return redirect('admin/user/manage/create')->with('flash_notice','ดำเนินเพิ่มข้อมูล '.$request['first_name'].' '.$request['last_name'].' สำเร็จ');

        }

        public function userShow()
        {

          $users = User::paginate(5);

          $data['users'] = $users;


          return \Response::json(view('admins.list.tableUser', $data)->render());

        }

        public function studentShow()
        {

          $students = User::whereHas('roles', function ($query) {
                     $query->where('name', '=', 'student');
          })->paginate(5);

          $data['users'] = $students;
          $data['students'] = $students;


          return \Response::json(view('admins.list.tableUser', $data)->render());

        }

        public function teacherShow()
        {

          $teachers = User::whereHas('roles', function ($query) {
                     $query->where('name', '=', 'teacher');
          })->paginate(5);

          $data['users'] = $teachers;
          $data['teachers'] = $teachers;

          return \Response::json(view('admins.list.tableUser', $data)->render());

        }

        public function adminShow()
        {

          $admins = User::whereHas('roles', function ($query) {
                     $query->where('name', '=', 'admin');
          })->paginate(5);

          $data['users'] = $admins;
          $data['admins'] = $admins;

          return \Response::json(view('admins.list.tableUser', $data)->render());

        }

        public function trashShow()
        {

          $trashs = User::onlyTrashed()->paginate(5);

          $data['users'] = $trashs;
          $data['trashs'] = $trashs;

          return \Response::json(view('admins.list.tableUserTrash', $data)->render());

        }


}
