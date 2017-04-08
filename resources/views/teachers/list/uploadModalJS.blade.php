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
