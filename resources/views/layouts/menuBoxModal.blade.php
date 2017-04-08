<a href="{{ $url }}" class="nonetran" data-toggle="modal" data-target="#editBox-{{ $id }}">
  <div class="col-md-4">
    <div class="{{ $colorClass }}">
      <div class="{{ $cir1Class}}">
        <div class="{{ $cir2Class}}">
          <div class="{{ $cir3Class}}">
            <div class="{{ $cir4Class}}">
              <h1 class="box-icon"><i class="{{ $iconClass}}"></i></h1>
            </div>
          </div>
        </div>
      </div>
      <h1 class="{{ $textClass }}"><b>{{ $name}}</b></h1>
      <p class="box-suptext ">{{ $menuDes }}</p>
    </div>
  </div>
</a>


<div class="modal fade" tabindex="-1" role="dialog" id="editBox-{{ $id }}">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">{{ $titleModal}}</h4>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/teacher/user/quiz/'.$id) }}">
      {{ csrf_field() }}
    <div class="modal-body">
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
        <div class='input-group date col-md-6' id='startTime{{ $id }}'>
          <input type='text' class="form-control" name="start" required/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-time"></span>
          </span>
        </div>
      </div>
      <div class="form-group">
        <label for="name" class="col-md-4 control-label">Expire</label>
        <div class='input-group date col-md-6' id='endTime{{ $id }}'>
          <input type='text' class="form-control" name="expire"required/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-time"></span>
          </span>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Create</button>
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
    minDate: new Date(),
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
