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
use Excel;
use App\Finish;

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
      if($questions->count() == 0){
        return back()->with([
          'flash_notice' =>'System: ยังไม่ได้เพิ่มคำถามในแบบทดสอบนี้',
          'flash_type' => 'danger ']);
      }
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


    public function downloadScore($course_id, $quiz_id)
    {



      $course = Course::find($course_id);
      $members = unserialize($course->member);

      $questions = Question::where('quiz_id', $quiz_id)->get();
      $studentList = User::whereIn('stud_id', $members)->get();
      $quizName = Quiz::find($quiz_id)->name;

      $membersCount = 0;
      foreach ($members as $key => $value) {
        $membersCount++;
      }

      $finishs = Finish::where([['course_id',$course_id], ['quiz_id', $quiz_id]])->get();

      foreach ($finishs as $key => $finish_value) {
        $quizScore['max'] = $finish_value->max('score');
        $quizScore['min'] = $finish_value->min('score');
        $quizScore['average'] = (int)$finish_value->sum('score') / $membersCount;
      }


      Excel::create('Score '.$quizName, function($excel)  use($studentList, $questions, $quiz_id, $quizName, $course, $quizScore) {

        $excel->sheet('First sheet', function($sheet) use($studentList, $questions, $quiz_id, $quizName, $course, $quizScore){
          $sheet->row(1, array(
            $course->code.' '.$course->name
          ));
          $sheet->row(2, array(
            '', 'Student', $quizName
          ));

          foreach ($studentList as $skey => $student) {
            $score[$student->stud_id]['correct'] = 0;

              foreach ($questions as $qkey => $question) {
                $response = Response::where([['user_id',$student->id],['quiz_id',$quiz_id],['question_id',$question->id]])->first();
                if(empty($response)){
                  //$score[$student->stud_id]['thinking']++;
                }else{
                  $studentAnswer[$student->stud_id][$question->id]['answer'] = $response->answer;

                  if(unserialize($question->answer) == $response->answer){
                    $score[$student->stud_id]['correct']++;
                  }else{
                    //$score[$student->stud_id]['wrong']++;
                  }
                }
              }

              $sheet->row($skey+3, array(
                $skey+1, $student->stud_id,   $score[$student->stud_id]['correct']
              ));
          }

          $sheet->row($studentList->count()+3, array(
            '', '', 'max = '.$quizScore['max']
          ));
          $sheet->row($studentList->count()+4, array(
            '', '', 'min = '.$quizScore['min']
          ));
          $sheet->row($studentList->count()+5, array(
            '', '', 'average = '.$quizScore['average']
          ));


        });


      })->export('csv');

    dd('download');
  }

}
