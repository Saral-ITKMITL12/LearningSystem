@extends('layouts.app')

 @section('content')
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.twbsPagination.js') }}" type="text/javascript"></script>

<link rel="stylesheet" href="{{ asset('css/bootstrap-chosen.css') }}">


<section class="features">
<div class="container">


  <div class="col-md-10 col-md-offset-1">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <h4>{{ $course->code}}: {{ $course->name}}</h4>
          <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('/teacher/course/addUser/'.$id) }}">
            {{ method_field('put') }}
            {{ csrf_field() }}
            <div class="form-group form-inline">
              <div class="col-md-5 col-md-offset-5">
                <select required data-placeholder="Add Student to Course" class="chosen-select" multiple="" style="width: 350px; display: none;" name="student[]" id="student">
                  @foreach($userSearch as $user)
                  <option value="{{ $user->stud_id }}">{{ $user->email}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-inline">
                <button type="submit" name="button" class="btn btn-success">Save</button>
              </div>
            </div>
          </form>
          <table class="table table-striped" id="courseMember">
          </table>
          <div class="text-center">
            <nav aria-label="Page navigation">
              <ul class="pagination" id="paginationUser"></ul>
            </nav>
          </div>
        </div>
    </div>
  </div>
</div>





<script src="{{ asset('js/chosen.jquery.js') }}" type="text/javascript"></script>

<script type="text/javascript">
      $('#paginationUser').twbsPagination({
        totalPages: {{ $users->lastPage() }},
        visiblePages: 3,
        onPageClick: function (event, page) {
          $.ajax({
            url: '/teacher/courseMemberPaginate/'+{{ $id }}+'?page='+page,
            dataType: 'json',
          }).done(function(data) {
            $('#courseMember').html(data);
            location.hash = page;
          }).fail(function() {
            alert('Posts could not be loaded.');
          });
        }
      });


      $('#student').chosen({
        width: "100%",
        no_results_text: "Oops, nothing found!",
      });

</script>
</section>

@endsection
