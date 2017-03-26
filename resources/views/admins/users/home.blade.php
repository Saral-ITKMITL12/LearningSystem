@extends('layouts.app')

@section('content')
<section class="features">
<div class="container">

    <a href="admin/user/course/create" class="nonetran">
      <div class="col-md-4">
        <div class="box-color">
          <div class="circle-1">
            <div class="circle-2">
              <div class="circle-3">
                <div class="circle-4">
                  <h1 class="box-icon"><i class="fa fa-book fa-2x fa-inverse"></i></h1>
                </div>
              </div>
            </div>
          </div>
          <h1 class="box-text"><b>COURSE</b></h1>
          <p class="box-suptext">create class and manage</p>
        </div>
      </div>
    </a>
    <a href="admin/user/manage/create" class="nonetran">
      <div class="col-md-4">
        <div class="box-color">
          <div class="circle-1">
            <div class="circle-2">
              <div class="circle-3">
                <div class="circle-4">
                  <h1 class="box-icon"><i class="fa fa-user fa-2x fa-inverse"></i></h1>
                </div>
              </div>
            </div>
          </div>
          <h1 class="box-text"><b>USER</b></h1>
          <p class="box-suptext ">create user and manage</p>
        </div>
      </div>
    </a>
</div>
</section>
  @endsection
