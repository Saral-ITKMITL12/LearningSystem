@extends('layouts.app')

@section('content')
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<link rel="stylesheet" href="/css/radioStyle.css">
<link rel="stylesheet" href="{{ asset('css\segmented-controls.css')}}">

<div class="" id="saveSucces"></div>

<section class="features">
<div class="container">

  <div class="col-md-10 col-md-offset-1 text-center" id="paginateHead">
      @if ($paginates->lastPage() > 1)
      <ul class="pagination">
          @for ($i = 1; $i <= $paginates->lastPage(); $i++)
              <a class="btn btn-round
              @if(!empty($resAry))
                    @if(in_array($questions[$i-1]->id, $resAry))
                    btn-save
                    @else
                    btn-unsave
                    @endif
                    @endif"
                id="pageQuestion{{ $i }}" data-token="{{ csrf_token() }}">{{ $i }}
              </a>

                <script type="text/javascript">
                  $("#pageQuestion{{ $i }}").on("click", function(){
                    var token = $(this).data('token');
                    $.ajax({
                      url: '/student/user/doQuizPage/{{ $quiz_id }}?page={{ $i }}',
                      type: 'POST',
                      data: {
                        _method: 'post',
                         _token :token,
                       },
                      dataType: 'json',
                    }).done(function(data) {
                      $('#componentQuestion').html(data);
                    }).fail(function() {
                      alert('error');
                    });
                  });
                </script>
          @endfor
      </ul>
      @endif
      <hr class="menuList">
  </div>

  <div class="col-md-10 col-md-offset-1 form-horizontal" id="componentQuestion">
    @foreach($paginates as $key => $value)

    @if($value->descript['type'] == 'trueOrfalse' )
      @include('students.list.trueChoice')
    @elseif($value->descript['type'] == 'fourChoice' )
      @include('students.list.fourChoice')
    @elseif($value->descript['type'] == 'word' )
      @include('students.list.wordChoice',['quiz_id' => $quiz_id])
    @endif

    @endforeach
  </div>

</section>




@endsection
