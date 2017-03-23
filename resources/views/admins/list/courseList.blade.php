<div class="panel panel-default">
  <div class="panel-heading panel-accordion">
    <h4 class="panel-title accordion-head">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $class}}">ป.ตรี ระดับชั้นปีที่ {{ $class}} </a>
      <span class="badge" style="background: #f5f5f5; color: #666">
        @if(!empty($courses[$class]))
        {{ $courses[$class]->count()}}
        @else 0
        @endif</span>
    </h4>
  </div>
  <div id="collapse{{ $class}}" class="panel-collapse collapse">
    <div class="panel-body">
      <div class="panel panel-default">
        @if(!empty($courses[$class]))
        @foreach( $courses[$class] as $key => $course)
         @if($course->class == $class)
          <div class="panel-heading">
          <a href="/admin/courseMember/{{ $course->id}}">{{ $course->code}} {{ $course->name}}</a>
          </div>
          <div class=" panel-body teacherCourse">
            @foreach( $teacherData[$class][$key] as $tkey => $tdata)
            <p>teacher: <span><a class="teacherName"href="#">{{ $teacherData[$class][$key][$tkey][0][0] }} {{ $teacherData[$class][$key][$tkey][1][0] }}</a></span></p>
            @endforeach
          </div>
        @endif
        @endforeach
        @endunless
      </div>
    </div>
  </div>
</div>
