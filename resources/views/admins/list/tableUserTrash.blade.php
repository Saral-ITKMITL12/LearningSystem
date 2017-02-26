
<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>FIRST NAME</th>
      <th>LAST NAME</th>
      <th>EMAIL</th>
      <th>EDIT</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)

    <tr>
      <td>{{ $user->id }}</td>
      <td>{{ $user->first_name }}</td>
      <td>{{ $user->last_name }}</td>
      <td>{{ $user->email }}</td>
      <td>
          <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#restore{{$user->id}}">
            <i class="fa fa-trash" aria-hidden="true"></i>
            restore
        </button>
        </td>
        <td>
          <form class="" action="{{ url('admin/user/manage/'.$user->id) }}" method="post"  onsubmit="return(confirm('การลบครั้งนี้จะไม่สามารถกู้คืนได้อีก คุณต้องการลบใช่หรื่อไม่?'))">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button class="btn btn-danger" type="submit">
              <i class="fa fa-trash" aria-hidden="true"></i>
              delete</button>
            </form>
          </td>
        </tr>

        <!-- Modal Restore -->
        <div class="modal fade" id="restore{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="restore">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Choose role to restore</h4>
              </div>
                <div class="modal-body">
                  <div class="form-group row text-center">
                    <form class="" action="{{ url('admin/user/restore/'.$user->id) }}" method="post">
                      {{ csrf_field() }}
                      <button class="btn btn-success btn-block btn-lg" type="submit">
                        Student</button>
                      </form>
                  </div>
                  <div class="form-group row text-center">
                    <form class="" action="{{ url('admin/user/restore/'.$user->id) }}" method="post">
                      {{ csrf_field() }}
                      <button class="btn btn-warning btn-block btn-lg" type="submit">
                        Teacher</button>
                      </form>
                  </div>
                  <div class="form-group row text-center">
                    <form class="" action="{{ url('admin/user/restore/'.$user->id) }}" method="post">
                      {{ csrf_field() }}
                      <button class="btn btn-info btn-block btn-lg" type="submit">
                        Admin</button>
                      </form>
                  </div>

                </div>
            </div>
          </div>
        </div>

      @endforeach
    </tbody>
  </table>
