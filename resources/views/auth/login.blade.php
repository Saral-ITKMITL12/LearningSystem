@extends('layouts.app')

@section('content')
<section class="features indexLogin">
<div class="container">


  <div class="col-md-5 col-md-offset-5 text-right" style="margin-top: 50px;">
      <h2 style="color: #363636;">Learning System</h2>
      <p style="color: #7a7a7a">Faculty of Information Technology @KMTIL</p>
      @include('auth.loginForm')
  </div>

</div>


</section>


@endsection
