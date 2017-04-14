<form class="" action="" method="post" enctype="multipart/form-data">


<div class="col-md-8 col-md-offset-2">
  @if($value->image != null)
  <div class="boxPanelQuiz">
    <div class="boxImagePanel">
        <a href="#image1">
          <img src="{{ $value->image }}" alt="" class="boxImageQuiz">
        </a>
    </div>
  </div>
  <a href="#" class="JesterBox">
    <div id="image1"><img src="{{ $value->image }}"></div>
</a>
  @endif
  <div class="boxAskPanel">
    {{ $paginates->currentPage() }}. {{ $value->descript['ask'] }}
  </div>
  <div class="col-md-12 text-center trueAnswer">
    <div class="segmented-control segmented-deepblue" id="sengment-1" style="width: 100%;">
      <input type="radio" name="answer" id="answer-1" value="true">
      <input type="radio" name="answer" id="answer-2" value="false">
      <label for="answer-1" data-value="True">True</label>
      <label for="answer-2" data-value="False">False</label>
    </div>
  </div>
  <div class="col-md-12 text-center saveNext">
    <button type="button" class="btn btn-gibson" name="button" id="saveQuiz" data-token="{{ csrf_token() }}">save</button>
    <button type="button" class="btn btn-gibson" name="button" id="finishQuiz">Finish</button>
  </div>
</div>

</form>

<script type="text/javascript">
  $("#saveQuiz").on("click", function(){


if($("input[name='answer']").is(":checked")){
  var token = $(this).data('token');
     $.ajax({
       url: '/student/user/doQuizUpdate/'+{{$value->id}},
       type: 'POST',
       data: {
         _method: 'patch',
          _token :token,
          questionType: 'trueOrfalse',
          answer: $("input[name='answer']:checked").val(),
          page: '{{ $paginates->currentPage() }}',
        },
       dataType: 'json',
     }).done(function(data) {
       $('#saveSucces').html(data);
     }).fail(function() {
       alert('error');
     });
}else{
  $.ajax({
    url: '/student/user/doQuizUpdateFail',
    type: 'GET',
    dataType: 'json',
  }).done(function(data) {
    $('#saveSucces').html(data);
  });
}


  });
</script>
