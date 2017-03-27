@extends('layouts.app')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>



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

    <div class="col-md-10 col-md-offset-1">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          
        </div>
      </div>
    </div>
  </div>








  <script type="text/javascript">
  $("#success-alert").fadeTo(2000, 500).slideUp(1000, function() {
    $("#success-alert").slideUp(3000);
  });

  </script>
</section>

@endsection
