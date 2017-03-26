@extends('layouts.app')

@section('content')
<header>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="header-content">
          <div class="header-content-inner">


            <div class="col-sm-5 text-center">
              <h1><span style="color: #fff;">Learning System</span></h1>
              <span style="color: #fff;">Faculty of Information Technology@KMITL</span>
            </div>

            <div class="col-sm-5">
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
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-ani btn-ani-login btn-3 btn-xl" name="button">Login</button>
                </div>

              </form>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</header>


@endsection
