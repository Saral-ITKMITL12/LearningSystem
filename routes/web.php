<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web']], function() {
  Auth::routes();

  Route::get('/home', 'HomeController@index');

  Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
    // Route::resource('/user/manage','Admin\UserManageController');
    Route::get('/user/manage/create','Admin\UserManageController@create');

    Route::put('/user/manage/{id}','Admin\UserManageController@softDelete');
    Route::post('/user/restore/{id}', 'Admin\UserManageController@restore');
    Route::delete('/user/manage/{id}','Admin\UserManageController@destroy');

    Route::post('/user/newUser', 'Admin\UserManageController@newUser');
    Route::get('/userShow', 'Admin\UserManageController@userShow');
    Route::get('/studentShow', 'Admin\UserManageController@studentShow');
    Route::get('/teacherShow', 'Admin\UserManageController@teacherShow');
    Route::get('/adminShow', 'Admin\UserManageController@adminShow');
    Route::get('/trashShow', 'Admin\UserManageController@trashShow');

    //import user to database and setting role-user
    Route::post('/user/manage/importTeachExcel', 'Admin\UserManageController@importTeachExcel');
    Route::post('/user/manage/importStdExcel', 'Admin\UserManageController@importStdExcel');

  });

  Route::group(['prefix' => 'teacher', 'middleware' => ['role:teacher']], function () {
    Route::resource('/user/classroom','Teacher\ClassRoomController');
    Route::post('/user/classroom/newclass','Teacher\ClassRoomController@newClass');
  });

});

Route::resource('/test','Teacher\ClassRoomController');

//configuration
// Route::get('/config', function () {
//
//       $user = new App\User();
//       $user->first_name = 'Admin';
//       $user->last_name = 'Administrator';
//       $user->email = 'admin@kmitl.ac.th';
//       $user->password = bcrypt('123456');
//       $user->save();
//
//       $admin = new App\Role();
//       $admin->name         = 'admin';
//       $admin->display_name = 'User Administrator'; // optional
//       $admin->description  = 'User is allowed to manage and edit other users'; // optional
//       $admin->save();
//
//
//       $user->attachRole($admin);
//
//
//       $teacher= new App\Role();
//       $teacher->name         = 'teacher';
//       $teacher->display_name = 'User Teacher'; // optional
//       $teacher->description  = 'User is allowed to manage and edit crouse keyroom'; // optional
//       $teacher->save();
//
//       $std = new App\Role();
//       $std->name         = 'Student';
//       $std->display_name = 'Student IT@KMITL'; // optional
//       $std->description  = 'User is allowed to quiz'; // optional
//       $std->save();
//
// });
