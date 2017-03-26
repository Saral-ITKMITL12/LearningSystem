<?php


Route::get('/', function () {

        if($this->middleware('auth')){
          return redirect('/home');
        }else{
          return view('index');
        }
});



Route::group(['middleware' => ['web']], function() {
  Auth::routes();

  Route::get('/home', 'HomeController@index');

  Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {

    Route::get('/user/manage/create','Admin\UserManageController@create');

    Route::delete('/user/manage/{id}','Admin\UserManageController@destroy');
    Route::post('/user/restore/{id}', 'Admin\UserManageController@restore');

    Route::post('/user/newUser', 'Admin\UserManageController@newUser');
    Route::get('/userShow', 'Admin\UserManageController@userShow');
    Route::get('/studentShow', 'Admin\UserManageController@studentShow');
    Route::get('/teacherShow', 'Admin\UserManageController@teacherShow');
    Route::get('/adminShow', 'Admin\UserManageController@adminShow');

    // import user to database and setting role-user
    Route::post('/user/manage/importTeachExcel', 'Admin\UserManageController@importTeachExcel');
    Route::post('/user/manage/importStdExcel', 'Admin\UserManageController@importStdExcel');

    // search user
    // Route::get('/search', 'Admin\UserManageController@searchUser');


    // course
    Route::get('/user/course/create','Admin\CourseManageController@create');
    Route::post('/user/course/','Admin\CourseManageController@store');
    Route::get('/courseMember/{id}','Admin\CourseManageController@courseMember');
    Route::get('/courseMemberPaginate/{id}','Admin\CourseManageController@courseMemberPaginate');
    Route::put('/course/addUser/{id}','Admin\CourseManageController@update');

  });

  Route::group(['prefix' => 'teacher', 'middleware' => ['role:teacher']], function () {
    Route::resource('/user/classroom','Teacher\CourseMangeController');
  });

});
