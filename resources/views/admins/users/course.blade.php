@extends('layouts.app')

@section('content')
  <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/jquery.twbsPagination.js') }}" type="text/javascript"></script>

  <link rel="stylesheet" href="{{ asset('css/bootstrap-chosen.css') }}">

<section class="features">
<div class="container">
  <div class="col-md-6 col-md-offset-3">
    @unless(empty(session('flash_notice')))
    <div class="alert alert-success alert-dismissible fade in" role="alert" id="success-alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>{{ Session::get('flash_notice') }}</strong>
    </div>
    @endunless

    @unless(empty(session('flash_fail')))
    <div class="alert alert-danger alert-dismissible fade in" role="alert" id="success-alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>{{ Session::get('flash_fail') }}</strong>
    </div>
    @endunless
  </div>
    <div class="col-md-5  col-md-offset-1">
        <h2>Course categories</h2>
    </div>
    <div class="col-md-5 text-right">
        <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#newCourse">New Course</button>
    </div>
    <div class="col-md-10 col-md-offset-1">
      <div class="panel-group" id="accordion">
        @include('admins.list.courseList', ['class' => 1])
        @include('admins.list.courseList', ['class' => 2])
        @include('admins.list.courseList', ['class' => 3])
        @include('admins.list.courseList', ['class' => 34])
        @include('admins.list.courseList', ['class' => 4])
      </div>
    </div>


<!-- Modal Import User -->
<div class="modal fade" id="newCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Course</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
              <form action="{{ URL::to('/admin/user/course') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="form-group">
                <input type="text" class="form-control" name="code"  required placeholder="course-code">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="name"  required placeholder="course-name">
              </div>
              <div class="form-group">
                <select required data-placeholder="class" class="chosen-select"  name="class" id="class">
                  <option value="1">ป.ตรี ระดับชั้นปีที่ 1</option>
                  <option value="2">ป.ตรี ระดับชั้นปีที่ 2</option>
                  <option value="3">ป.ตรี ระดับชั้นปีที่ 3</option>
                  <option value="34">ป.ตรี ระดับชั้นปีที่ 3/4</option>
                  <option value="4">ป.ตรี ระดับชั้นปีที่ 4</option>
                </select>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="descript"  required placeholder="description">
              </div>
              <div class="form-group">
                    <select required data-placeholder="teacher" class="chosen-select" multiple="" style="width: 350px; display: none;" name="teacher[]" id="teacher">
                      @foreach($teachers as $teacher)
                      <option value="{{ $teacher->id }}">{{ $teacher->email}}</option>
                      @endforeach
                    </select>
              </div>
              <label class="custom-file">
                <input type="file" id="import_file" name="import_file" class="custom-file-input">
                <span class="custom-file-control"></span>
              </label>
              <div class="col-md-11 col-md-offset-1 text-right"><br>
                <button type="submit" name="button" class="btn btn-success text-right">Import</button>
              </div>

              </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
  <script src="{{ asset('js/chosen.jquery.js') }}" type="text/javascript"></script>
  <script type="text/javascript">

    $("#success-alert").fadeTo(2000, 500).slideUp(1000, function(){
      $("#success-alert").slideUp(3000);
    });

    $('#teacher').chosen({
      width: "100%",
      max_selected_options: 3,
      no_results_text: "Oops, nothing found!",
    });

    $('#class').chosen({
      width: "100%",
      no_results_text: "Oops, nothing found!",
    });
  </script>
</section>

  @endsection
