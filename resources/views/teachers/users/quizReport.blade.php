@extends('layouts.app')

@section('content')


<section class="features">
  <div class="container">
        <div class="col-md-6">
          <h3 class="drakText">{{ $quiz->name }} SCORE BOARD</h3>
          <p class="doftDrakText">{{ $course->code }} {{ $course->name }}</p>
        </div>
    <div class="col-md-6 text-right">
      <a class="btn btn-correct statusWidth" >CORRECT</a>
      <a class="btn btn-wrong statusWidth" >WRONG</a>
      <a class="btn btn-thinking statusWidth" >THINKING</a>
    </div>

    <div class="col-md-12">
      <table class="table text-center" >
        <tr class="bulmaBlue ">
          <th class="text-center">Student ID</th>
          <th class="text-center"><i class="fa fa-check-circle" aria-hidden="true"></i></i></th>
          <th class="text-center"><i class="fa fa-times-circle" aria-hidden="true"></i></th>
          <th class="text-center"><i class="fa fa-question-circle" aria-hidden="true"></i></th>
          @for($i=0; $i< $question_count; $i++)
          <th class="text-center">{{ $i+1 }}</th>
          @endfor
        </tr>
        @foreach($studentAnswer as $key => $student)
        <tr>
          <td>{{ $key }}</td>
          <td>{{ $score[$key]['correct'] }}</td>
          <td>{{ $score[$key]['wrong'] }}</td>
          <td>{{ $score[$key]['thinking'] }}</td>
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

@endsection
