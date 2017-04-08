@extends('layouts.app')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('css\segmented-controls.css')}}">



<section class="features">
  <div class="container">

    <div class="col-md-12">
      <h4>{{ $quiz->name }}</h4>
      <p class="textSupBoxGray">{{ $course->code }}: {{ $course->name }}</p>
      <div class="col-md-12">
          <a href="#trueChoice" data-toggle="modal" data-target="#trueChoice" class="btn btn-primary ">
            True or False
            <i class="fa fa-plus-square" aria-hidden="true"></i>
          </a>
          <a href="#fourChoice" data-toggle="modal" data-target="#fourChoice" class="btn btn-success ">
            Four Choice
            <i class="fa fa-plus-square" aria-hidden="true"></i>
          </a>
          <a href="#word" data-toggle="modal" data-target="#word" class="btn btn-warning ">
            word
            <i class="fa fa-plus-square" aria-hidden="true"></i>
          </a>
      </div>
    </div>


    @include('teachers.list.questionList')

  </div>

  @include('teachers.form.questionModalTrue',['id' => $course->id, 'key' => 'trueChoice'])
  @include('teachers.form.questionModalFour',['id' => $course->id, 'key' => 'fourChoice'])
  @include('teachers.form.questionModalword',['id' => $course->id, 'key' => 'word'])

</section>

@endsection
