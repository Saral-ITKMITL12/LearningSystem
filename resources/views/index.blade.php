@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login.css')}}" rel="stylesheet">

<div class="container">
  <div class="row" style="margin-top: 15%;">
    <div class="col-md-4 col-md-offset-2 text-right">
      <h1><span style="color: #fff;">Learning</span> <span style="color: #1CB5E0;">System</span></h1>
      <h4><span style="color: #fff;">Faculty of Information Technology@KMITL</span></h4>
    </div>
    <div class="col-md-3 text-center">
      <form class="form-horizontal" role="form" method="POST" action="{{ url('login') }}" style="padding-top: 25px;" id="loginForm">
          {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email">
          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
        </div>
        <a href="#" class="btn animated-button gibson-one" id="submitBtn">Login</a> </div>

      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
      document.getElementById("submitBtn").onclick = function() {
        document.getElementById("loginForm").submit();
      }
</script>
@endsection
