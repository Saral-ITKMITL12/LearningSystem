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


    Route::get('/user/course/create','Teacher\CourseManageController@create');
    Route::get('/user/course/intocourse/{id}','Teacher\CourseManageController@intoCourse');
    Route::get('/user/userCouseManage/{id}','Teacher\CourseManageController@userCouseManage');
    Route::get('/courseMemberPaginate/{id}','Teacher\CourseManageController@courseMemberPaginate');
    Route::put('/course/addUser/{id}','Teacher\CourseManageController@update');

    // quiz
    // Route::get('/user/quiz/create/{id}','Teacher\QuizManageController@create');
    Route::post('/user/quiz/{id}','Teacher\QuizManageController@store');
    Route::get('/user/quiz/{id}','Teacher\QuizManageController@show');
    Route::get('/user/quiz/{id}/edit','Teacher\QuizManageController@edit');
    Route::get('/user/quiz/delete/{id}','Teacher\QuizManageController@destroy');
    Route::put('/user/quiz/{id}','Teacher\QuizManageController@update');

    // Question
    Route::get('/quiz/question/index/{id}','Teacher\QuestionManageController@index');
    Route::get('/quiz/question/{id}','Teacher\QuestionManageController@show');

    Route::post('/quiz/question/trueStore/{id}','Teacher\QuestionManageController@trueStore');
    Route::put('/quiz/question/trueStore/{id}','Teacher\QuestionManageController@trueUpdate');

    Route::post('/quiz/question/fourStore/{id}','Teacher\QuestionManageController@fourStore');
    Route::put('/quiz/question/fourStore/{id}','Teacher\QuestionManageController@fourUpdate');

    Route::post('/quiz/question/wordStore/{id}','Teacher\QuestionManageController@wordStore');
    Route::put('/quiz/question/wordStore/{id}','Teacher\QuestionManageController@wordUpdate');

    Route::delete('/quiz/question/{id}','Teacher\QuestionManageController@destroy');

    Route::get('/qiuz/ScoreReport/{id}/select','Teacher\ScoreController@index');
    Route::get('/qiuz/ScoreReport/{course_id}/{quiz_id}/view','Teacher\ScoreController@create');

  });

  Route::group(['prefix' => 'student', 'middleware' => ['role:student']], function () {


    Route::get('/user/course/create','Student\CourseController@create');
    Route::get('/user/course/intocourse/{id}','Student\CourseController@intoCourse');

    Route::get('/user/quiz/{id}','Student\QuizController@index');
    Route::get('/user/doQuiz/{id}','Student\QuizController@doQuiz');
    Route::post('/user/doQuizPage/{id}','Student\QuizController@doQuizPage');
    Route::post('/user/doQuizPageHead/{id}','Student\QuizController@doQuizPageHead');

    Route::patch('/user/doQuizUpdate/{id}','Student\QuizController@quizUpdate');
    Route::get('/user/doQuizUpdateFail','Student\QuizController@quizUpdateFail');


  });


});
