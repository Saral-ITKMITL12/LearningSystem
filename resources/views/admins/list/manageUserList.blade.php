<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>FIRST NAME</th>
      <th>LAST NAME</th>
      <th>EMAIL</th>
      <th>ROLE</th>
      <th>EDIT</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)

    <tr>
      <td>{{ $user->stud_id }}</td>
      <td>{{ $user->first_name }}</td>
      <td>{{ $user->last_name }}</td>
      <td>{{ $user->email }}</td>
      <td>@if($user->hasRole('admin'))Admin
        @elseif( $user->hasRole('teacher'))Teacher
        @elseif( $user->hasRole('student'))Student
        @endif
      </td>
      <td>
        <form class="" action="{{ url('admin/user/manage/'.$user->id) }}" method="post"  onsubmit="return(confirm('คุณต้องการลบใช่หรื่อไม่?'))">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <button class="btn btn-danger" type="submit">
            <i class="fa fa-trash" aria-hidden="true"></i></button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
