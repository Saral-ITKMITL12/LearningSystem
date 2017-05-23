@extends('layouts.app')

@section('content')


<section class="features">
  <div class="container">
        <div class="col-md-6">
          <h3 class="drakText">{{ $quiz->name }} SCORE BOARD</h3>
          <p class="subTextSubject">{{ $course->code }} {{ $course->name }}</p>
        </div>
        <div class="col-md-6 text-right">
          <form class="" action="{{ url('/teacher/qiuz/ScoreReport/'.$course_id.'/'.$quiz_id.'/download') }}" method="post" target="_blank">
            {{ csrf_field() }}
            <button class="btn btn-correct downloadBTN" type="submit"><i class="fa fa-file-text" aria-hidden="true"></i> Export</button>
          </form>
        </div>

    <div class="col-md-12" id="tableScore">
      <div class="col-md-6 text-left">
        <a class="btn btn-correct statusWidth" ></a> <span class="statusInfo">CORRECT</span>
        <a class="btn btn-wrong statusWidth" ></a> <span class="statusInfo">WRONG</span>
        <a class="btn btn-thinking statusWidth" ></a> <span class="statusInfo">THINKING</span>
      </div>
      <br>
      <table class="table text-center" >
        <tr class="bulmaBlue ">
          <th class="text-center">Student ID</th>
          <th class="text-center leftTD"><i class="fa fa-check-circle" aria-hidden="true"></i></i></th>
          <th class="text-center"><i class="fa fa-times-circle" aria-hidden="true"></i></th>
          <th class="text-center rightTD"><i class="fa fa-question-circle" aria-hidden="true"></i></th>
          @for($i=0; $i< $question_count; $i++)
          <th class="text-center">{{ $i+1 }}</th>
          @endfor
        </tr>
        @foreach($studentAnswer as $key => $student)
        <tr>
          <td>{{ $key }}</td>
          <td class="leftTD">{{ $score[$key]['correct'] }}</td>
          <td>{{ $score[$key]['wrong'] }}</td>
          <td class="rightTD">{{ $score[$key]['thinking'] }}</td>
          @foreach($student as $skey => $value)
          <td class="text-center">
          @if($value['status'] == "correct")
          <a class="btn btn-correct" >
            @if( $value['answer'] == '0')
            A
            @elseif( $value['answer'] == '1')
            B
            @elseif( $value['answer'] == '2')
            C
            @elseif( $value['answer'] == '3')
            D
            @elseif( $value['answer'] == 'true')
            T
            @elseif( $value['answer'] == 'false')
            F
            @else
            {{ $value['answer']}}
            @endif
          </a>
          @elseif($value['status'] == "wrong")
          <a class="btn btn-wrong" >
            @if( $value['answer'] == '0')
            A
            @elseif( $value['answer'] == '1')
            B
            @elseif( $value['answer'] == '2')
            C
            @elseif( $value['answer'] == '3')
            D
            @elseif( $value['answer'] == 'true')
            T
            @elseif( $value['answer'] == 'false')
            F
            @else
            {{ $value['answer']}}
            @endif
          </a>
          @elseif($value['status'] == "thinking")
          <a class="btn btn-thinking" >?</a>
          @endif
          </td>
          @endforeach
        </tr>
        @endforeach
    </table>
    </div>




  </div>

</section>

<script src="https://js.pusher.com/4.0/pusher.min.js"></script>
<script>

  // Enable pusher logging - don't include this in production
  // Pusher.logToConsole = true;

  var pusher = new Pusher('7435ecf02992f7d22974', {
    cluster: 'ap1',
    encrypted: true
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('update-score', function() {

    $.ajax({
      url: '/teacher/qiuz/ScoreReport/{{$course_id}}/{{$quiz_id}}/refresh',
      type: 'GET',
      dataType: 'json',
    }).done(function(data) {
      $('#tableScore').html(data);
    }).fail(function() {
      alert('error');
    });

  });

</script>


@endsection
