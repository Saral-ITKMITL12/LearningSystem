<div class="modal fade" tabindex="-1" role="dialog" id="trueChoice">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">True or False Question</h4>
    </div>
      <form action="{{ url('/teacher/quiz/question/trueStore/'.$id) }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="modal-body">

        <div class="row">
          <div class="form-group col-md-10 col-md-offset-1">
            <h4>Question</h4>
            <textarea name="ask" class="form-control" id="question"  rows="3" required ></textarea>
          </div>

          <div class="form-group col-md-10 col-md-offset-1">
            <h4>Image File</h4>
            <input type="file" id="image{{ $key }}" name="image" class="custom-file-input">
          </div>


          <div class="checkbox col-md-10 col-md-offset-1" id="image{{ $key }}box" style="display: none;">
            <input type="radio" name="imagePick" value="true" required checked="">
            <img src="" alt="" class="modalimg" id="myImg{{ $key }}">
            <a href="#" class="btn btn-danger" id="clear{{ $key }}"><i class="fa fa-close" aria-hidden="true"></i></a>
            <input type="text" id="delete{{ $key }}" name="delete" value="notDelete" style="display: none;">
          </div>


          <div class="col-md-10 col-md-offset-1 ">
            <h4>Answer</h4>
            <div class="segmented-control" id="sengment-{{ $key }}">
              <input type="radio" name="answer" id="answer-{{ $key }}-1" value="true" checked="">
              <input type="radio" name="answer" id="answer-{{ $key }}-2" value="false">
              <label for="answer-{{ $key }}-1" data-value="True">True</label>
              <label for="answer-{{ $key }}-2" data-value="False">False</label>
            </div>
          </div>


          <script type="text/javascript">

          if($('input[id=answer-{{ $key }}-1]').is(':checked')){
                $("#sengment-{{ $key }}").addClass("segmented-green")
            } else {
                $("#sengment-{{ $key }}").addClass("segmented-red")
            }


            $('input[id=answer-{{ $key }}-1]').change(function(){
              if($('input[id=answer-{{ $key }}-1]').is(':checked')){
                    $("#sengment-{{ $key }}").removeClass("segmented-red").addClass("segmented-green")
                } else {
                    $("#sengment-{{ $key }}").removeClass("segmented-green").addClass("segmented-red")
                }
            });

            $('input[id=answer-{{ $key }}-2]').change(function(){
              if($('input[id=answer-{{ $key }}-2]').is(':checked')){
                    $("#sengment-{{ $key }}").removeClass("segmented-green").addClass("segmented-red")
                } else {
                    $("#sengment-{{ $key }}").removeClass("segmented-red").addClass("segmented-green")
                }
            });


            $("#image{{ $key }}").change(function () {
              if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded{{$key}};
                reader.readAsDataURL(this.files[0]);
              }
            });

            function imageIsLoaded{{$key}}(e) {
              $("#image{{ $key }}box").show();
              $("#myImg{{ $key }}").attr('src', e.target.result);
              $("#delete{{ $key }}").val('notDelete');
            };


            $("#clear{{ $key }}").on("click", function(){
              $("#image{{ $key }}box").hide();
              $("#image{{ $key }}").val('');
              $("#delete{{ $key }}").val('delete');
            });

          </script>

        </div>
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
