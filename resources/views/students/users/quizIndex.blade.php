@extends('layouts.app')

@section('content')

<section class="features">
<div class="container">

  @foreach($quizs as $key => $quiz)

    @include('layouts.menuBox',[
    'url' => '/student/user/doQuiz/'.$quiz->id,
    'name' => $quiz->name,
    'colorClass' => 'box-color box-color-'.'blue',
    'cir1Class' => 'circle-1 circle-1-'.'blue',
    'cir2Class' => 'circle-2 circle-2-'.'blue',
    'cir3Class' => 'circle-3 circle-3-'.'blue',
    'cir4Class' => 'circle-4 circle-4-'.'blue',
    'textClass' => 'box-text2',
    'iconClass' => "fa fa-book fa-2x fa-inverse",
    'menuDes' => '',
    ])
  @endforeach

</div>



</section>

@endsection
