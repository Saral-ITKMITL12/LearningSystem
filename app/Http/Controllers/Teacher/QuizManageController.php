<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Quiz;
use App\Course;

class QuizManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
    public function create($id)
    {
        // $data['id'] = $id;
        // return view('teachers.users.quizCreate', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        // $splitName = explode('/ ', $request['start']);
        // dd($splitName);


        $quiz = new Quiz();
        $quiz->course_id = $id;
        $quiz->name = $request['name'];
        $quiz->descript = $request['descript'];
        $quiz->start_date = $request['start'];
        $quiz->expire_date = $request['expire'];

        $quiz->save();

        return redirect('teacher/quiz/question/index/'.$id)->with([
          'flash_notice' =>'System: ดำเนินการเพิ่มข้อมูล สำเร็จ',
           'flash_type' => 'success ']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        $quizs = Quiz::where('course_id',$id)->get();



        $data['quizs'] = $quizs;
        $data['course'] = $course;

        return view('teachers.users.quizEdit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd('edit');
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
        $quiz = Quiz::find($id);
        $id = $quiz->course_id;

        $quiz->name = $request['name'];
        $quiz->descript = $request['descript'];
        $quiz->start_date = $request['start'];
        $quiz->expire_date = $request['expire'];

        $quiz->save();

        return redirect('teacher/quiz/question/index/'.$id)->with([
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
        $quiz = Quiz::find($id);
        $id = $quiz->course_id;
        $quiz->forceDelete();

        return redirect('teacher/quiz/question/index/'.$id)->with([
          'flash_notice' =>'System: ดำเนินการลบข้อมูล สำเร็จ',
           'flash_type' => 'success ']);
    }
}
