<div class="col-md-10 col-md-offset-1 ">
  <h4>Answer</h4>
  <div class="segmented-control" id="sengment-{{ $key }}">
    <input type="radio" name="answer" id="answer-{{ $key }}-1" value="true" @if($question->descript['answer'] == 'true') checked @endif>
    <input type="radio" name="answer" id="answer-{{ $key }}-2" value="false"@if($question->descript['answer'] == 'false') checked @endif>
    <label for="answer-{{ $key }}-1" data-value="True">True</label>
    <label for="answer-{{ $key }}-2" data-value="False">False</label>
  </div>
</div>
