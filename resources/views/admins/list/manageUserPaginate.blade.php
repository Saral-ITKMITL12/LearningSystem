<div class="tab-pane fade {{ $class }}" role="tabpanel" id="{{ $name }}" aria-labelledby="{{ $name }}-tab">
  <div class="bs-example" data-example-id="contextual-table">
    <br>
    <table class="table table-striped" id="{{ $name }}UserTable">
      <!-- content -->
    </table>
    <div class="text-center">
      <nav aria-label="Page navigation">
        <ul class="pagination" id="{{ $name }}paginate"></ul>
      </nav>
    </div>

    <script type="text/javascript">
    $('#{{ $name }}paginate').twbsPagination({
      totalPages: {{ $users->lastPage() }},
      visiblePages: 3,
      onPageClick: function (event, page) {
        $.ajax({
          url: '{{ $url }}?page='+page,
          dataType: 'json',
        }).done(function(data) {
          $('#{{ $name }}UserTable').html(data);
          location.hash = '{{ $name }}User?page='+page;
        }).fail(function() {
          alert('Posts could not be loaded.');
        });
      }
    });
    </script>
  </div>

</div>
