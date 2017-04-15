  @if($value->image != null)
  <div class="imageBox"><img src="{{ $value->image }}" alt="" class="imageQuiz">
    <a href="#image1">


    <div class="overlayImage">
      <div class="textOverlay"><h2><i class="fa fa-search-plus" aria-hidden="true"></i></h2></div>
    </div>
  </a>
  </div>
  <hr>
  <a href="#" class="JesterBox">
    <div id="image1"><img src="{{ $value->image }}"></div>
  </a>
  @endif
  <div class="askBox">
    {{ $paginates->currentPage() }}. {{ $value->descript['ask'] }}
  </div>

  <div class="col-md-12 answerBox">
    <div class="segmented-control segmented-bulma" id="sengment-1" style="width: 100%;">
      <input type="radio" name="answer" id="answer-1" value="true"
      @for($i = 1; $i <= $paginates->lastPage(); $i++)
        @foreach($resArray as $rkey => $resValue)
        @if($resValue['id'] == $value->id)
        @if($resValue['answer'] == 'true')
            checked=""
          @endif
        @endif
      @endforeach
      @endfor>
      <input type="radio" name="answer" id="answer-2" value="false"
      @for($i = 1; $i <= $paginates->lastPage(); $i++)
        @foreach($resArray as $rkey => $resValue)
        @if($resValue['id'] == $value->id)
        @if($resValue['answer'] == 'false')
            checked=""
          @endif
        @endif
      @endforeach
      @endfor>
      <label for="answer-1" data-value="True">True</label>
      <label for="answer-2" data-value="False">False</label>
    </div>
    <hr>
  </div>
  <div class="col-md-12 text-center saveNext">
    <button type="button" class="btn btn-gibson" name="button" id="saveQuiz" data-token="{{ csrf_token() }}">save</button>
    <button type="button" class="btn btn-bulgreen" name="button" id="finishQuiz">Finish</button>
  </div>



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

      $.ajax({
        url: '/student/user/doQuizPageHead/{{ $quiz_id }}',
        type: 'POST',
        data: {
          _method: 'post',
           _token :token,
         },
        dataType: 'json',
      }).done(function(data) {
        $('#paginateHead').html(data);
      });

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
