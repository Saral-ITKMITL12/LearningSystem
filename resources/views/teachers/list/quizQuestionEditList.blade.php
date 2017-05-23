<a href="{{ url('/teacher/quiz/question/'.$id) }}">
<div class="col-md-4">

  <div class="col-md-12 quizBox quizBox-ani">
    <div class="icon-big">
      <i class="fa fa-book" aria-hidden="true"></i>
    </div>
    <div class="col-md-12">
      <h1 class="textHeadBox">{{ $quiz->name }}</h1>
    </div>
    <div class="col-md-12">
      <p class="textSupBox">Descript: {{ $quiz->descript }}</p>
      <span class="textSupBox">Time: {{ $quiz->start_date }} - {{ $quiz->expire_date }}</span>
    </div>
    <div class="col-md-12  text-right">
      <a href="{{ url('/teacher/user/quiz/delete/'.$id) }}" class="btn btn-danger " onclick="return confirm('Are you want Delete?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
      <a href="#editBox-{{ $id }}" data-toggle="modal" data-target="#editBox-{{ $id }}" class="btn btn-primary "><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    </div>
  </div>
  </div>
</a>



  <div class="modal fade" tabindex="-1" role="dialog" id="editBox-{{ $id }}">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ $quiz->name }}</h4>
      </div>
      <form class="form-horizontal" role="form" method="POST" action="{{ url('/teacher/user/quiz/'.$id) }}">
        {{ method_field('put') }}
        {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-group">
          <label for="name" class="col-md-4 control-label">Name </label>
          <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" required value="{{ $quiz->name }}">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-md-4 control-label">Descript</label>
          <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="descript" required value="{{ $quiz->descript }}">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-md-4 control-label">Start</label>
          <div class='input-group date col-md-6' id='startTime{{ $id }}'>
            <input type='text' class="form-control" name="start" required value="{{ $quiz->start_date }}"/>
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-time"></span>
            </span>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-md-4 control-label">Expire</label>
          <div class='input-group date col-md-6' id='endTime{{ $id }}'>
            <input type='text' class="form-control" name="expire"required value="{{ $quiz->expire_date }}"/>
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-time"></span>
            </span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">

    var $startTime{{ $id }} = $('#startTime{{ $id }}');
    var $endTime{{ $id }} = $('#endTime{{ $id }}');

    $startTime{{ $id }}.datetimepicker({
      locale: 'th',
    });
    $endTime{{ $id }}.datetimepicker({
      useCurrent: false,
    });

    $startTime{{ $id }}.on("dp.change", function(e) {
      $endTime{{ $id }}.data("DateTimePicker").minDate(e.date);
    });

    $endTime{{ $id }}.on("dp.change", function(e) {
      $startTime{{ $id }}.data("DateTimePicker").maxDate(e.date);
    });

    $endTime{{ $id }}.on("dp.show", function(e) {
      if (!$endTime{{ $id }}.data("DateTimePicker").date()) {
        var defaultDate = $startTime{{ $id }}.data("DateTimePicker").date().add(1, 'hours');
        $endTime{{ $id }}.data("DateTimePicker").defaultDate(defaultDate);
      }
    });

</script>
