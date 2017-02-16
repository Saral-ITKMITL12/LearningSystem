@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Page</div>

                <div class="panel-body">
                  <a href="{{ url('admin/user/manage/create') }}">
                    <button type="submit" class="btn btn-primary">ManageUser</button>
                  </a>
                  <a href="{{ url('admin/user/roleaccess/create') }}">
                    <button type="submit" class="btn btn-primary">RoleAccess</button>
                  </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
