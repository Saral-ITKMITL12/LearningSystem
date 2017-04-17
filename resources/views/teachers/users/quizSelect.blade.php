@extends('layouts.app')

@section('content')


<section class="features">
  <div class="container">


    <div class="text-right">
      <h4>{{ $course->code}}: {{ $course->name}}</h4>
      <br>
    </div>

      @foreach($quizs as $key => $quiz)
      @include('teachers.list.quizReportList',[
      'id' => $quiz->id,
      'quiz' => $quiz,
      ])
      @endforeach



  </div>

</section>

@endsection
