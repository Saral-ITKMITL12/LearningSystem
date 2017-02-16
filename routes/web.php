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
    Route::resource('/user/manage','Admin\ManageController');
    Route::resource('/user/roleaccess','Admin\RoleAccessController');
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
//       $admin = new App\Role();
//       $admin->name         = 'admin';
//       $admin->display_name = 'User Administrator'; // optional
//       $admin->description  = 'User is allowed to manage and edit other users'; // optional
//       $admin->save();
//
//       $teacher= new App\Role();
//       $teacher->name         = 'teacher';
//       $teacher->display_name = 'User Teacher'; // optional
//       $teacher->description  = 'User is allowed to manage and edit crouse keyroom'; // optional
//       $teacher->save();
//
//       $user_admin = App\User::where('name', '=', 'admin')->first();
//
//       // role attach alias
//       $user_admin->attachRole($admin); // parameter can be an Role object, array, or id
//
//       // or eloquent's original technique
//       //*** $user->roles()->attach($admin->id); // id only
//
//
//       $user_teacher = App\User::where('name', '=', 'teacher1')->first();
//       // role attach alias
//       $user_teacher->attachRole($teacher); // parameter can be an Role object, array, or id
//
//       // or eloquent's original technique
//       //*** $user->roles()->attach($teacher->id); // id only
//
// });
