<?php


Route::get('/', function () {
    return view('index');
});
Route::get('/index', function () {
    return view('index');
});


Route::group(['middleware' => ['web']], function() {
  Auth::routes();

  Route::get('/home', 'HomeController@index');

  Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
    // Route::resource('/user/manage','Admin\UserManageController');
    Route::get('/user/manage/create','Admin\UserManageController@create');

    Route::delete('/user/manage/{id}','Admin\UserManageController@destroy');
    Route::post('/user/restore/{id}', 'Admin\UserManageController@restore');

    Route::post('/user/newUser', 'Admin\UserManageController@newUser');
    Route::get('/userShow', 'Admin\UserManageController@userShow');
    Route::get('/studentShow', 'Admin\UserManageController@studentShow');
    Route::get('/teacherShow', 'Admin\UserManageController@teacherShow');
    Route::get('/adminShow', 'Admin\UserManageController@adminShow');
    Route::get('/trashShow', 'Admin\UserManageController@trashShow');

    //import user to database and setting role-user
    Route::post('/user/manage/importTeachExcel', 'Admin\UserManageController@importTeachExcel');
    Route::post('/user/manage/importStdExcel', 'Admin\UserManageController@importStdExcel');


    //class
    Route::get('/user/course/create','Admin\CourseManageController@create');
    Route::post('/user/course/','Admin\CourseManageController@store');
    Route::get('/courseMember/{id}','Admin\CourseManageController@courseMember');

  });

  Route::group(['prefix' => 'teacher', 'middleware' => ['role:teacher']], function () {
    Route::resource('/user/classroom','Teacher\ClassRoomController');
    Route::post('/user/classroom/newclass','Teacher\ClassRoomController@newClass');
  });

});
