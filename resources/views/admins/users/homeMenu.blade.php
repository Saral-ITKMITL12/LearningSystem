@extends('layouts.app')

@section('content')
<div class="container">

    <a href="admin/user/course/create">
      <div class="col-md-4">
        <div class="box-color">
          <div class="circle-1">
            <div class="circle-2">
              <div class="circle-3">
                <div class="circle-4">
                  <h1 class="box-icon"><i class="fa fa-book fa-2x fa-inverse box-icon"></i></h1>
                </div>
              </div>
            </div>
          </div>
          <h1 class="box-text"><b>COURSE</b></h1>
          <p class="box-suptext">create class and manage</p>
        </div>
      </div>
    </a>
    <a href="admin/user/manage/create">
      <div class="col-md-4">
        <div class="box-color">
          <div class="circle-1">
            <div class="circle-2">
              <div class="circle-3">
                <div class="circle-4">
                  <h1 class="box-icon"><i class="fa fa-user fa-2x fa-inverse box-icon"></i></h1>
                </div>
              </div>
            </div>
          </div>
          <h1 class="box-text"><b>USER</b></h1>
          <p>crate user and manage</p>
        </div>
      </div>
    </a>
</div>

  @endsection
