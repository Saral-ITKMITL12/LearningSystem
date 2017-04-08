@extends('layouts.app')

@section('content')
<section class="features">
<div class="container">



    @include('layouts.menuBox',[
    'url' => 'admin/user/course/create',
    'name' => 'COURSE',
    'colorClass' => 'box-color box-color-'.'green',
    'cir1Class' => 'circle-1 circle-1-'.'green',
    'cir2Class' => 'circle-2 circle-2-'.'green',
    'cir3Class' => 'circle-3 circle-3-'.'green',
    'cir4Class' => 'circle-4 circle-4-'.'green',
    'textClass' => 'box-text',
    'iconClass' => "fa fa-book fa-2x fa-inverse",
    'menuDes' => 'create course and manage'
    ])

    @include('layouts.menuBox',[
    'url' => 'admin/user/manage/create',
    'name' => 'USER',
    'colorClass' => 'box-color box-color-'.'orange',
    'cir1Class' => 'circle-1 circle-1-'.'orange',
    'cir2Class' => 'circle-2 circle-2-'.'orange',
    'cir3Class' => 'circle-3 circle-3-'.'orange',
    'cir4Class' => 'circle-4 circle-4-'.'orange',
    'textClass' => 'box-text',
    'iconClass' => "fa fa-user fa-2x fa-inverse",
    'menuDes' => 'create user and manage'
    ])

</div>
</section>
  @endsection
