<a href="{{ url('/teacher/qiuz/ScoreReport/'.$quiz->course_id.'/'.$id.'/view') }}">
<div class="col-md-4">

  <div class="col-md-12 quizBox quizBox-ani">
    <div class="icon-big">
      <i class="fa fa-book" aria-hidden="true"></i>
    </div>
    <div class="col-md-12">
      <h1 class="textHeadBox">{{ $quiz->name }}</h1>
    </div>
    <div class="col-md-12">
      <p class="textSupBox">Descript: {{ $quiz->descript }}</p>
      <span class="textSupBox">Time: {{ $quiz->start_date }} - {{ $quiz->expire_date }}</span>
    </div>
  </div>
  </div>
</a>
