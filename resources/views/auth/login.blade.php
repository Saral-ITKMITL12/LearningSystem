@extends('layouts.app')

@section('content')
<section class="features indexLogin">
<div class="container">


  <div class="col-md-5 col-md-offset-5 text-right" style="margin-top: 50px;">
      <p style="color: #363636; font-size: 2.5em">Learning System</p>
      <p style="color: #7a7a7a">Faculty of Information Technology @KMITL</p>
      @include('auth.loginForm')
  </div>

</div>


</section>


@endsection
