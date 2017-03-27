@extends('layouts.app')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css')}}">
<script src="{{ asset('js\moment.js') }}" charset="utf-8"></script>
<script src="{{ asset('js\th.js') }}" charset="utf-8"></script>
<script src="{{ asset('js\bootstrap-datetimepicker.min.js') }}" charset="utf-8"></script>



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
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/teacher/user/quiz/'.$id) }}">
            {{ csrf_field() }}

            <div class="form-group">
              <label for="name" class="col-md-4 control-label">Name </label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" required>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-md-4 control-label">Descript</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="descript" required>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-md-4 control-label">Start</label>
              <div class='input-group date col-md-6' id='startTime1'>
                <input type='text' class="form-control" name="start"/>
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-time"></span>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-md-4 control-label">Expire</label>
              <div class='input-group date col-md-6' id='endTime1'>
                <input type='text' class="form-control" name="expire"/>
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-time"></span>
                </span>
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








  <script type="text/javascript">
  $("#success-alert").fadeTo(2000, 500).slideUp(1000, function() {
    $("#success-alert").slideUp(3000);
  });



  var $startTime1 = $('#startTime1');
  var $endTime1 = $('#endTime1');

  $startTime1.datetimepicker({
    locale: 'th',
    minDate: new Date(),
  });
  $endTime1.datetimepicker({
    useCurrent: false,
  });

  $startTime1.on("dp.change", function(e) {
    $endTime1.data("DateTimePicker").minDate(e.date);
  });

  $endTime1.on("dp.change", function(e) {
    $startTime1.data("DateTimePicker").maxDate(e.date);
  });

  $endTime1.on("dp.show", function(e) {
    if (!$endTime1.data("DateTimePicker").date()) {
      var defaultDate = $startTime1.data("DateTimePicker").date().add(1, 'hours');
      $endTime1.data("DateTimePicker").defaultDate(defaultDate);
    }
  });



  </script>
</section>

@endsection
