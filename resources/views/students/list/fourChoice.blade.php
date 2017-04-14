@foreach($value->descript['answer'] as $qkey => $answer)
<li class="list-group-item">
<div class="form-group">
<div class="col-md-1">
  <div class="btn-group btn-group-vertical" data-toggle="buttons">
    <label class="btn" >
      <input type="radio" name='answerRadio{{$key}}' value="">
      <i class="fa fa-square-o fa-2x"></i>
      <i class="fa fa-check-square-o fa-2x"></i>
    </label>
  </div>
</div>
<div class="col-md-10">
  {{ $choices[$qkey]}}) {{ $answer }}
</div>
</div>
</li>
@endforeach
