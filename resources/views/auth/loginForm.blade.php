<form class="form-horizontal" role="form" method="POST" action="{{ url('login') }}" style="padding-top: 25px;" id="loginForm">
  {{ csrf_field() }}
  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <input id="email" type="email" class="text" name="email" value="{{ old('email') }}" required placeholder="Email">
    @if ($errors->has('email'))
    <span class="help-block">
      <strong>{{ $errors->first('email') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <input id="password" type="password" class="text" name="password" required placeholder="Password">
    @if ($errors->has('password'))
    <span class="help-block">
      <strong>{{ $errors->first('password') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group text-center">
    <button type="submit" class="btn btn-gibson" name="button">Login</button>
  </div>

</form>
