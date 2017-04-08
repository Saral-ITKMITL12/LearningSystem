<div class="col-md-10 col-md-offset-1">
  <br>
  @unless(empty($questions))
    @foreach ($questions as $key => $question)
    <div class="col-md-12">
      <div class="list-group">
        <li class="list-group-item active">
          <a class="quizbox" href="#quizbox-{{ $key}}" data-toggle="modal" data-target="#quizbox-{{ $key}}">{{ $key+1}}. {{ $question->descript['ask']}}</a>
          @if($question->image != null)
            <span class="badge"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
          @endif
        </li>

        @if($question->descript['type'] == 'trueOrfalse')
        <li class="list-group-item">A) True
          @if($question->descript['answer'] == 'true')
            <span class="badge badge-green"><i class="fa fa-check" aria-hidden="true"></i></span>
          @endif
        </li>
        <li class="list-group-item">B) False
          @if($question->descript['answer'] == 'false')
            <span class="badge badge-green"><i class="fa fa-check" aria-hidden="true"></i></span>
          @endif
        </li>

        @elseif($question->descript['type'] == 'fourChoice')
          @foreach ($question->descript['answer'] as $akey => $answer)
          <li class="list-group-item">{{ $choices[$akey]}}) {{ $answer }}
            @if($question->descript['answerRadio'] == $akey)
              <span class="badge badge-green"><i class="fa fa-check" aria-hidden="true"></i></span>
            @endif
          </li>
          @endforeach
        @endif
      </div>

    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="quizbox-{{ $key}}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit {{ $key+1}}.</h4>
        </div>
        @if($question->descript['type'] == 'trueOrfalse')
          <form action="{{ url('/teacher/quiz/question/trueStore/'.$question->id) }}" method="post" enctype="multipart/form-data">
        @elseif($question->descript['type'] == 'fourChoice')
          <form action="{{ url('/teacher/quiz/question/fourStore/'.$question->id) }}" method="post" enctype="multipart/form-data">
        @endif
        {{ method_field('PUT') }}
          {{ csrf_field() }}
          <div class="modal-body">

            <div class="row">
              <div class="form-group col-md-10 col-md-offset-1">
                <h4>Question</h4>
                <textarea name="ask" class="form-control" id="question"  rows="3" required >{{ $question->descript['ask']}}</textarea>
              </div>

              <div class="form-group col-md-10 col-md-offset-1">
                <h4>Image File</h4>
                <input type="file" id="image{{ $key }}" name="image" class="custom-file-input">
              </div>


              <div class="checkbox col-md-10 col-md-offset-1" id="image{{ $key }}box"
                @if($question->image == null) style="display: none;" @endif >
                <input type="radio" name="imagePick" value="true" required checked="">
                <img src="{{ $question->image }}" alt="" class="modalimg" id="myImg{{ $key }}">
                <a href="#" class="btn btn-danger" id="clear{{ $key }}"><i class="fa fa-close" aria-hidden="true"></i></a>
                <input type="text" id="delete{{ $key }}" name="delete" value="notDelete" style="display: none;">
              </div>

              @if($question->descript['type'] == 'trueOrfalse')
                @include('teachers.form.trueRadio')
              @elseif($question->descript['type'] == 'fourChoice')
                @include('teachers.form.fourRadio')
              @endif


              <!-- text/javascript -->
              @include('teachers.list.uploadModalJS')

            </div>
          </div>
        <div class="modal-footer">
          <div class="col-md-4 text-left">
            <a class="btn btn-danger" onclick="document.getElementById('myform{{ $key }}').submit()"><i class="fa fa-trash" aria-hidden="true" ></i></a>
          </div>
          <div class="col-md-8 text-right">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </form>
      <form action="/teacher/quiz/question/{{ $question->id}}" method="post" enctype="multipart/form-data" id="myform{{ $key }}">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
      </form>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    @endforeach
  @endunless
</div>
