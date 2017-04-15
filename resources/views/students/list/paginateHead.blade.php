@if ($paginates->lastPage() > 1)
<ul class="pagination">
    @for ($i = 1; $i <= $paginates->lastPage(); $i++)
        <a class="btn btn-round
              @if(in_array($questions[$i-1]->id, $resAry))
              btn-save
              @else
              btn-unsave
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
