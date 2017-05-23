<div class="col-md-12 text-center saveNext">
  <button type="button" class="btn btn-gibson" name="button" id="saveQuiz" data-token="{{ csrf_token() }}">save</button>
  <a href="/student/user/quizFininsh/{{ $quiz->id}}">
  <button type="button" class="btn btn-bulgreen" name="button" id="finishQuiz">Finish</button>
  </a>
</div>
