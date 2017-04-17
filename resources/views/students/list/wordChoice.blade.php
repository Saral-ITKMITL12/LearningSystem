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
    <input type="text" name="answer" class="form-control"
      @if(!empty($resArray))
    @for($i = 1; $i <= $paginates->lastPage(); $i++)
      @foreach($resArray as $rkey => $resValue)
      @if($resValue['id'] == $value->id)
          value="{{ $resValue['answer']}}"
      @endif
    @endforeach
    @endfor
    @endif>

    <hr>
  </div>
  <div class="col-md-12 text-center saveNext">
    <button type="button" class="btn btn-gibson" name="button" id="saveQuiz" data-token="{{ csrf_token() }}">save</button>
    <button type="button" class="btn btn-bulgreen" name="button" id="finishQuiz">Finish</button>
  </div>



<script type="text/javascript">
$("#saveQuiz").on("click", function(){



    var token = $(this).data('token');
    $.ajax({
      url: '/student/user/doQuizUpdate/'+{{$value->id}},
      type: 'POST',
      data: {
        _method: 'patch',
        _token :token,
        questionType: 'word',
        answer: $("input[name='answer']").val(),
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


});
</script>
