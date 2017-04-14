@foreach($paginates as $key => $value)

@if($value->descript['type'] == 'trueOrfalse' )
  @include('students.list.trueChoice')
@elseif($value->descript['type'] == 'fourChoice' )
  @include('students.list.fourChoice')
@endif


@endforeach
