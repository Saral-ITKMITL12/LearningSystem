@extends('layouts.app')

@section('content')

<section class="features">
<div class="container">



  <div class="col-md-12">
    <h3>{{ $course->code }} {{ $course->name }}</h3>
    <br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Quiz</th>
        <th>Your Score</th>
      </tr>
    </thead>
    <tbody>
        @foreach($myFinishs as $key => $myFinish)
      <tr>
        <td>{{ $quiz[$key]->name }}</td>
        <td>{{ $myFinish->score }} of {{ $quizScores[$myFinish->quiz_id]['count'] }} </td>
      </tr>
        @endforeach
    </tbody>
  </table>
  </div>




</div>



</section>

@endsection
