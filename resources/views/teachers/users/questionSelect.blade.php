@extends('layouts.app')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css')}}">
<script src="{{ asset('js\moment.js') }}" charset="utf-8"></script>
<script src="{{ asset('js\th.js') }}" charset="utf-8"></script>
<script src="{{ asset('js\bootstrap-datetimepicker.min.js') }}" charset="utf-8"></script>



<section class="features">
  <div class="container">


    <div class="text-right">
      <h4>{{ $course->code}}: {{ $course->name}}</h4>
      <br>
    </div>

      @foreach($quizs as $key => $quiz)
      @include('teachers.list.quizQuestionEditList',[
      'id' => $quiz->id,
      'quiz' => $quiz,
      ])
      @endforeach



  </div>

</section>

@endsection
