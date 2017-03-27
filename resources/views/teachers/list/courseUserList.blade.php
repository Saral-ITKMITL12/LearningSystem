<table class="table table-striped" id="courseMember">
  <thead>
    <tr>
      <th>ID</th>
      <th>FIRST NAME</th>
      <th>LAST NAME</th>
      <th>EMAIL</th>
      <th>ROLE</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $key => $user)

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
      </tr>
      @endforeach
    </tbody>
  </table>
