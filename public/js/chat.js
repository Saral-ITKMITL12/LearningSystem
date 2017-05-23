  var div = $("#style-1");
  div.scrollTop(div.prop('scrollHeight'));

  var token = $("#message").data('token');

  function commentPostEnter() {
    if (event.keyCode == 13) {

      comment_message = $('#message').val();

      csrf = $('meta[name="csrf-param"]').attr('content');

      if (comment_message != '') {


        $.ajax({
          url: "/course/forum/{{ $course->id }}/store",
          type: 'POST',
          data: {
            _method: 'post',
            _token: token,
            message: comment_message,
          },
          dataType: 'json',
        }).done(function(data) {
          $('#style-1').append(data);
          div.scrollTop(div.prop('scrollHeight'));// scroll down

        }).fail(function() {
          alert('error');
        });
      }
    }
  };
