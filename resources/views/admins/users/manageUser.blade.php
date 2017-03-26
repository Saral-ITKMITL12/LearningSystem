@extends('layouts.app')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.twbsPagination.js') }}" type="text/javascript"></script>



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

  <div class="row">
    <div class="col-md-10 col-md-offset-1">

      <div class="row">
        <div class="col-md-10 col-md-offset-1 text-right">
          <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#newUser">New User</button>
          <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#importUser">Import User</button>
        </div>
        <div class="col-md-10 col-md-offset-1">
          <br>
          <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#all" id="all-tab" role="tab" data-toggle="tab" aria-controls="all" aria-expanded="true">All User</a>
              </li>
              <li role="presentation" class="">
                <a href="#student" role="tab" id="student-tab" data-toggle="tab" aria-controls="student" aria-expanded="false">Student</a>
              </li>
              <li role="presentation" class="">
                <a href="#teacher" role="tab" id="teacher-tab" data-toggle="tab" aria-controls="teacher" aria-expanded="false">Teacher</a>
              </li>
              <li role="presentation" class="">
                <a href="#admin" role="tab" id="admin-tab" data-toggle="tab" aria-controls="admin" aria-expanded="false">Admin</a>
              </li>
            </ul>

            <div class="tab-content" id="myTabContent">

              <!-- paginate and Tab -->
              @include('admins.list.manageUserPaginate',
                ['class' => "active in",
                'name' => "all",
                 'users' => $users,
                 'url' => '/admin/userShow/'])

                 @include('admins.list.manageUserPaginate',
                   ['class' => "",
                   'name' => "student",
                    'users' => $students,
                    'url' => '/admin/studentShow/'])

                    @include('admins.list.manageUserPaginate',
                      ['class' => "",
                      'name' => "teacher",
                       'users' => $teachers,
                       'url' => '/admin/teacherShow/'])

                       @include('admins.list.manageUserPaginate',
                         ['class' => "",
                         'name' => "admin",
                          'users' => $admins,
                          'url' => '/admin/adminShow/'])



            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


<!-- Modal New User -->
<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New User</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('/admin/user/newUser') }}">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="name" class="col-md-4 control-label">Role</label>
            <div class="col-md-6">
              <input type="radio" name="role" value="2" class="form-inline" required> Teacher
              <input type="radio" name="role" value="3" class="form-inline"> Student
              <input type="radio" name="role" value="1" class="form-inline"> Admin
            </div>
          </div>

          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">FirstName</label>

            <div class="col-md-6">
              <input id="name" type="text" class="form-control" name="first_name" value="{{ old('name') }}" required autofocus>

              @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">LastName</label>

            <div class="col-md-6">
              <input id="name" type="text" class="form-control" name="last_name" value="{{ old('name') }}" required autofocus>

              @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

              @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Password</label>

            <div class="col-md-6">
              <input id="password" type="password" class="form-control" name="password" required>

              @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

            <div class="col-md-6">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                Register
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Import User -->
<div class="modal fade" id="importUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Import User</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h4 style="color: #fff;">Student</h4>
              </div>

              <div class="panel-body">

                <form action="{{ URL::to('/admin/user/manage/importStdExcel') }}" class="form-inline" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <label class="custom-file">
                    <input type="file" id="import_file" name="import_file" class="custom-file-input">
                    <span class="custom-file-control"></span>
                  </label>
                  <div class="col-md-11 col-md-offset-1 text-right"><br>
                    <button type="submit" name="button" class="btn btn-primary text-right">Import</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="panel panel-primary" style="border-color: #5cb85c;">
              <div class="panel-heading" style="background: #5cb85c; border-color: #5cb85c;">
                <h4 style="color: #fff;">Teacher</h4>
              </div>

              <div class="panel-body">

                <form action="{{ URL::to('/admin/user/manage/importTeachExcel') }}" class="form-inline" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
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
  </div>
</div>


<script type="text/javascript">

    $("#success-alert").fadeTo(2000, 500).slideUp(1000, function(){
      $("#success-alert").slideUp(3000);
    });

</script>

</section>

@endsection
