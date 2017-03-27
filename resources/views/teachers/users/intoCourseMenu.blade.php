@extends('layouts.app')

@section('content')

<section class="features">
<div class="container">

  @include('teachers.list.menuBox',[
  'url' => '/teacher/user/quiz/create/'.$id,
  'name' => 'New Quiz',
  'colorClass' => 'box-color box-color-'.'green',
  'cir1Class' => 'circle-1 circle-1-'.'green',
  'cir2Class' => 'circle-2 circle-2-'.'green',
  'cir3Class' => 'circle-3 circle-3-'.'green',
  'cir4Class' => 'circle-4 circle-4-'.'green',
  'textClass' => 'box-text',
  'iconClass' => "fa fa-plus-square-o fa-2x fa-inverse",
  'menuDes' => 'create quiz and manage'
  ])

  @include('teachers.list.menuBox',[
  'url' => '/teacher/user/quiz/'.$id,
  'name' => 'Quiz Edit',
  'colorClass' => 'box-color box-color-'.'pink',
  'cir1Class' => 'circle-1 circle-1-'.'pink',
  'cir2Class' => 'circle-2 circle-2-'.'pink',
  'cir3Class' => 'circle-3 circle-3-'.'pink',
  'cir4Class' => 'circle-4 circle-4-'.'pink',
  'textClass' => 'box-text',
  'iconClass' => "fa fa-pencil-square-o fa-2x fa-inverse",
  'menuDes' => 'create quiz and manage'
  ])

  @include('teachers.list.menuBox',[
  'url' => '/teacher/user/userCouseManage/'.$id,
  'name' => 'Question Edit',
  'colorClass' => 'box-color box-color-'.'blue',
  'cir1Class' => 'circle-1 circle-1-'.'blue',
  'cir2Class' => 'circle-2 circle-2-'.'blue',
  'cir3Class' => 'circle-3 circle-3-'.'blue',
  'cir4Class' => 'circle-4 circle-4-'.'blue',
  'textClass' => 'box-text',
  'iconClass' => "fa fa-question-circle-o fa-2x fa-inverse",
  'menuDes' => 'create quiz and manage'
  ])

  @include('teachers.list.menuBox',[
  'url' => '/teacher/user/userCouseManage/'.$id,
  'name' => 'Quiz Report',
  'colorClass' => 'box-color box-color-'.'orange',
  'cir1Class' => 'circle-1 circle-1-'.'orange',
  'cir2Class' => 'circle-2 circle-2-'.'orange',
  'cir3Class' => 'circle-3 circle-3-'.'orange',
  'cir4Class' => 'circle-4 circle-4-'.'orange',
  'textClass' => 'box-text',
  'iconClass' => "fa fa-bar-chart fa-2x fa-inverse",
  'menuDes' => 'create quiz and manage'
  ])

  @include('teachers.list.menuBox',[
  'url' => '/teacher/user/userCouseManage/'.$id,
  'name' => 'User Manage',
  'colorClass' => 'box-color box-color-'.'purple',
  'cir1Class' => 'circle-1 circle-1-'.'purple',
  'cir2Class' => 'circle-2 circle-2-'.'purple',
  'cir3Class' => 'circle-3 circle-3-'.'purple',
  'cir4Class' => 'circle-4 circle-4-'.'purple',
  'textClass' => 'box-text',
  'iconClass' => "fa fa-user fa-2x fa-inverse",
  'menuDes' => 'create user and manage'
  ])


</div>
</section>

@endsection
