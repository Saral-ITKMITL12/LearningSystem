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
        $users = User::paginate(10);
        $data['users'] = $users;

        $students = User::whereHas('roles', function ($query) {
                   $query->where('name', '=', 'student');
        })->paginate(10);
        $data['students'] = $students;

        $teachers = User::whereHas('roles', function ($query) {
                   $query->where('name', '=', 'teacher');
        })->paginate(10);
        $data['teachers'] = $teachers;

        $admins = User::whereHas('roles', function ($query) {
                   $query->where('name', '=', 'admin');
        })->paginate(10);
        $data['admins'] = $admins;

        return view('admins.users.manageUser', $data);
    }

    public function softDelete($id)
    {
      $user = User::find($id);
      $user->delete();
      return redirect('admin/user/manage/create')->with([
        'flash_notice' =>'System: ดำเนินการลบข้อมูล สำเร็จ',
         'flash_type' => 'success']);
    }
    public function destroy($id)
    {
      $user = User::find($id);
      $user->forceDelete();
      return redirect('admin/user/manage/create')->with([
        'flash_notice' =>'System: ดำเนินการลบข้อมูล สำเร็จ',
         'flash_type' => 'success']);
    }

    public function restore($id)
    {
      dd('restore');
      $user = User::onlyTrashed($id);
      $user->restore();
      return redirect('admin/user/manage/create')->with([
        'flash_notice' =>'System: ดำเนินการกู้ข้อมูล สำเร็จ',
         'flash_type' => 'success']);
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
          return redirect('admin/user/manage/create')->with([
            'flash_notice' =>'System: ดำเนินการเพิ่มข้อมูล สำเร็จ',
             'flash_type' => 'success']);
        }
        return redirect('admin/user/manage/create')->with([
          'flash_notice' =>'System: เกิดข้อผิดพลาด กรุณาเลือกไฟล์เพื่อทำรายการต่อ',
           'flash_type' => 'danger']);
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
            return redirect('admin/user/manage/create')->with([
              'flash_notice' =>'System: ดำเนินการเพิ่มข้อมูล สำเร็จ',
               'flash_type' => 'success ']);
          }
          return redirect('admin/user/manage/create')->with([
            'flash_notice' =>'System: เกิดข้อผิดพลาด กรุณาเลือกไฟล์เพื่อทำรายการต่อ',
             'flash_type' => 'danger']);
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


          $user_role = Role::find($request['role']);
          $user->attachRole($user_role);


          return redirect('admin/user/manage/create')->with([
            'flash_notice' =>'System: ดำเนินการเพิ่มข้อมูล สำเร็จ',
             'flash_type' => 'success ']);

        }

        public function userShow()
        {

          $users = User::paginate(10);

          $data['users'] = $users;


          return \Response::json(view('admins.list.manageUserList', $data)->render());

        }

        public function studentShow()
        {

          $students = User::whereHas('roles', function ($query) {
                     $query->where('name', '=', 'student');
          })->paginate(10);

          $data['users'] = $students;



          return \Response::json(view('admins.list.manageUserList', $data)->render());

        }

        public function teacherShow()
        {

          $teachers = User::whereHas('roles', function ($query) {
                     $query->where('name', '=', 'teacher');
          })->paginate(10);

          $data['users'] = $teachers;


          return \Response::json(view('admins.list.manageUserList', $data)->render());

        }

        public function adminShow()
        {

          $admins = User::whereHas('roles', function ($query) {
                     $query->where('name', '=', 'admin');
          })->paginate(10);

          $data['users'] = $admins;


          return \Response::json(view('admins.list.manageUserList', $data)->render());

        }


        // public function searchUser(Request $request)
        // {
        //   $keyword = $request['keyword'];
        //   $users = User::where('stud_id', 'LIKE', '%'.$keyword.'%')
        //   ->orWhere('first_name', 'LIKE', '%'.$keyword.'%')
        //   ->orWhere('last_name', 'LIKE', '%'.$keyword.'%')
        //   ->orWhere('email', 'LIKE', '%'.$keyword.'%')->paginate(10);
        //
        //   $data['users'] = $users;
        //   $data['name'] = 'search';
        //   $data['url'] = '/admin/search/';
        //   $data['class'] = 'active in';
        //
        //   return \Response::json(view('admins.list.manageUserList', $data)->render());
        // }


}
