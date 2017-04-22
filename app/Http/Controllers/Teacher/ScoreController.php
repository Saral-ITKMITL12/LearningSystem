<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Course;
use App\User;
use App\Quiz;
use App\Question;
use App\Response;
use Carbon\Carbon;

class ScoreController extends Controller
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

    public function index($id)
    {
      $course = Course::find($id);
      $quizs = Quiz::where('course_id',$id)->get();

      $data['quizs'] = $quizs;
      $data['course'] = $course;
      return view('teachers.users.quizSelect', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($course_id, $quiz_id)
    {


      $course = Course::find($course_id);
      $members = unserialize($course->member);

      $questions = Question::where('quiz_id', $quiz_id)->get();

      $studentList = User::whereIn('stud_id', $members)->get();

      foreach ($studentList as $skey => $student) {
        $score[$student->stud_id]['correct'] = 0;
        $score[$student->stud_id]['wrong'] = 0;
        $score[$student->stud_id]['thinking'] = 0;

          foreach ($questions as $qkey => $question) {
            $response = Response::where([['user_id',$student->id],['quiz_id',$quiz_id],['question_id',$question->id]])->first();
            if(empty($response)){
              $studentAnswer[$student->stud_id][$question->id]['status'] = 'thinking';
              $score[$student->stud_id]['thinking']++;
            }else{
              $studentAnswer[$student->stud_id][$question->id]['answer'] = $response->answer;

              if(unserialize($question->answer) == $response->answer){
                $studentAnswer[$student->stud_id][$question->id]['status'] = 'correct';
                $score[$student->stud_id]['correct']++;
              }else{
                $studentAnswer[$student->stud_id][$question->id]['status'] = 'wrong';
                $score[$student->stud_id]['wrong']++;
              }
            }
          }
      }


      // dd($studentAnswer);

      $data['studentAnswer'] = $studentAnswer;
      $data['question_count'] = $questions->count();
      $data['quiz'] = Quiz::find($quiz_id);
      $data['course'] = $course;
      $data['score'] = $score;
      $data['quiz_id'] = $quiz_id;
      $data['course_id'] = $course->id;


      return view('teachers.users.quizReport', $data);
    }

    public function updateScore($course_id, $quiz_id)
    {


      $course = Course::find($course_id);
      $members = unserialize($course->member);

      $questions = Question::where('quiz_id', $quiz_id)->get();

      $studentList = User::whereIn('stud_id', $members)->get();

      foreach ($studentList as $skey => $student) {
        $score[$student->stud_id]['correct'] = 0;
        $score[$student->stud_id]['wrong'] = 0;
        $score[$student->stud_id]['thinking'] = 0;

          foreach ($questions as $qkey => $question) {
            $response = Response::where([['user_id',$student->id],['quiz_id',$quiz_id],['question_id',$question->id]])->first();
            if(empty($response)){
              $studentAnswer[$student->stud_id][$question->id]['status'] = 'thinking';
              $score[$student->stud_id]['thinking']++;
            }else{
              $studentAnswer[$student->stud_id][$question->id]['answer'] = $response->answer;

              if(unserialize($question->answer) == $response->answer){
                $studentAnswer[$student->stud_id][$question->id]['status'] = 'correct';
                $score[$student->stud_id]['correct']++;
              }else{
                $studentAnswer[$student->stud_id][$question->id]['status'] = 'wrong';
                $score[$student->stud_id]['wrong']++;
              }
            }
          }
      }


      // dd($studentAnswer);

      $data['studentAnswer'] = $studentAnswer;
      $data['question_count'] = $questions->count();
      $data['quiz'] = Quiz::find($quiz_id);
      $data['course'] = $course;
      $data['score'] = $score;

      return \Response::json(view('teachers.list.scoreTable', $data)->render());
    }



}
