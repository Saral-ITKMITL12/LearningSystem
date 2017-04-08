<div class="col-md-10 col-md-offset-1 form-horizontal ">
  <h4>Answer</h4>
  @foreach ($choices as $ckey => $choice)
  <div class="form-group">
    <div class="col-md-2">
      <div class="btn-group btn-group-vertical" data-toggle="buttons">
        <label class="btn" >
          <input type="radio" name='answerRadio' value="{{ $ckey }}" @if($question->descript['answerRadio'] == $ckey) checked @endif>
          <i class="fa fa-square-o fa-2x"></i>
          <i class="fa fa-check-square-o fa-2x"></i>
          <span>{{ $choice }} </span>
        </label>
      </div>
    </div>
    <div class="col-md-10">
      <input type="text" name="answer[]" class="form-control" value="{{ $question->descript['answer'][$ckey] }}">
    </div>
  </div>
  @endforeach

</div>
