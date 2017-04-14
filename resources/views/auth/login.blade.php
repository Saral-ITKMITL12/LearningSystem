@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/loginStyle.css')}}">
<section class="features indexLogin">
<div class="container">


  <div class="col-md-5 col-md-offset-5 text-right" style="margin-top: 50px;">
      <h2 style="color: #fff;">Learning System</h2>
      <p style="color: #fff">Faculty of Information Technology @KMTIL</p>
      @include('auth.loginForm')
  </div>

</div>


</section>


@endsection
