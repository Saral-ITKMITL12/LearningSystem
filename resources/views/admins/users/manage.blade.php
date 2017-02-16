@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Manage Page</div>

        <div class="panel-body">

          <div class="bs-example" data-example-id="contextual-table">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#ID</th>
                  <th>NAME</th>
                  <th>ROLE</th>
                  <th>EDIT</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>@if($user->hasRole('admin'))Admin
                      @elseif( $user->hasRole('teacher'))Teacher
                      @else Student
                      @endif
                  </td>
                  <td>
                    <a href="{{ url('admin/user/manage/create') }}">
                      <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div><!-- body panel -->
      </div>
    </div>
  </div>
</div>

@endsection
