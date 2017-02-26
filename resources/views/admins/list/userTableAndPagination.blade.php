<div class="tab-pane fade active in" role="tabpanel" id="all" aria-labelledby="all-tab">
  <div class="bs-example" data-example-id="contextual-table">
    <br>
    <table class="table table-striped" id="allUserTable">
      <!-- content -->
    </table>
    <div class="text-center">
      <nav aria-label="Page navigation">
        <ul class="pagination" id="paginationUser"></ul>
      </nav>
    </div>

    <script type="text/javascript">
    $('#paginationUser').twbsPagination({
      totalPages: {{ $users->lastPage() }},
      visiblePages: 3,
      onPageClick: function (event, page) {
        $.ajax({
          url: '/admin/userShow/?page='+page,
          dataType: 'json',
        }).done(function(data) {
          $('#allUserTable').html(data);
          location.hash = 'showAllUser?page='+page;
        }).fail(function() {
          alert('Posts could not be loaded.');
        });
      }
    });
    </script>
  </div>

</div>


<div class="tab-pane" role="tabpanel" id="student" aria-labelledby="student-tab">
  <div class="bs-example" data-example-id="contextual-table">
    <br>
    <table class="table table-striped" id="studentTable">
      @if(($students->lastPage()) ==0)
      <h4 style="color: #ff4444" class="text-center">ไม่พบข้อมูล</h4>
      @endif
    </table>
    <div class="text-center">
      <nav aria-label="Page navigation">
        <ul class="pagination" id="paginationStudent"></ul>
      </nav>
    </div>
    @if(($teachers->lastPage()) >= 1)
    <script type="text/javascript">
    $('#paginationStudent').twbsPagination({
      totalPages: {{ $students->lastPage() }},
      visiblePages: 3,
      onPageClick: function (event, page) {
        $.ajax({
          url: '/admin/studentShow/?page='+page,
          dataType: 'json',
        }).done(function(data) {
          $('#studentTable').html(data);
          location.hash = 'showStudentUser?page='+page;
        }).fail(function() {
          alert('Posts could not be loaded.');
        });
      }
    });
    </script>
    @endif
  </div>
</div>

<div class="tab-pane" role="tabpanel" id="teacher" aria-labelledby="teacher-tab">
  <div class="bs-example" data-example-id="contextual-table">
    <br>
    <table class="table table-striped" id="teacherTable">
      @if(($teachers->lastPage()) ==0)
      <h4 style="color: #ff4444" class="text-center">ไม่พบข้อมูล</h4>
      @endif
    </table>
    <div class="text-center">
      <nav aria-label="Page navigation">
        <ul class="pagination" id="paginationTeacher"></ul>
      </nav>
    </div>
    @if(($teachers->lastPage()) >= 1)
    <script type="text/javascript">
    $('#paginationTeacher').twbsPagination({
      totalPages: {{ $teachers->lastPage() }},
      visiblePages: 3,
      onPageClick: function (event, page) {
        $.ajax({
          url: '/admin/teacherShow/?page='+page,
          dataType: 'json',
        }).done(function(data) {
          $('#teacherTable').html(data);
          location.hash = 'showTeacherUser?page='+page;
        }).fail(function() {
          alert('Posts could not be loaded.');
        });
      }
    });
    </script>
    @endif
  </div>
</div>

<div class="tab-pane" role="tabpanel" id="admin" aria-labelledby="admin-tab">
  <div class="bs-example" data-example-id="contextual-table">
    <br>
    <table class="table table-striped" id="adminTable">
      @if(($admins->lastPage()) ==0)
      <h4 style="color: #ff4444" class="text-center">ไม่พบข้อมูล</h4>
      @endif
    </table>
    <div class="text-center">
      <nav aria-label="Page navigation">
        <ul class="pagination" id="paginationAdmin"></ul>
      </nav>
    </div>
    @if(($admins->lastPage()) >= 1)
    <script type="text/javascript">
    $('#paginationAdmin').twbsPagination({
      totalPages: {{ $admins->lastPage() }},
      visiblePages: 3,
      onPageClick: function (event, page) {
        $.ajax({
          url: '/admin/adminShow/?page='+page,
          dataType: 'json',
        }).done(function(data) {
          $('#adminTable').html(data);
          location.hash = 'showAdminUser?page='+page;
        }).fail(function() {
          alert('Posts could not be loaded.');
        });
      }
    });
    </script>
    @endif
  </div>
</div>

<div class="tab-pane" role="tabpanel" id="trash" aria-labelledby="trash-tab">
  <div class="bs-example" data-example-id="contextual-table">
    <br>
    <table class="table table-striped" id="trashTable">
      @if(($trashs->lastPage()) ==0)
      <h4 style="color: #ff4444" class="text-center">ไม่พบข้อมูล</h4>
      @endif
    </table>
    <div class="text-center">
      <nav aria-label="Page navigation">
        <ul class="pagination" id="paginationTrash"></ul>
      </nav>
    </div>
    @if(($trashs->lastPage()) >= 1)
    <script type="text/javascript">
    $('#paginationTrash').twbsPagination({
      totalPages: {{ $trashs->lastPage() }},
      visiblePages: 3,
      onPageClick: function (event, page) {
        $.ajax({
          url: '/admin/trashShow/?page='+page,
          dataType: 'json',
        }).done(function(data) {
          $('#trashTable').html(data);
          location.hash = 'showTrashUser?page='+page;
        }).fail(function() {
          alert('Posts could not be loaded.');
        });
      }
    });
    </script>
    @endif
  </div>
</div>
