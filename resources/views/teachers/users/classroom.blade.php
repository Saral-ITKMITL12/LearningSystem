@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">ClassRoom Page</div>

        <div class="panel-body">

          <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal">New Class</button>

        </div><!-- body panel -->
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">New Class Room</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="newclass" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label class="col-sm-2 control-label">ClassName</label>
              <div class="col-sm-10">
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">KeyRoom</label>
              <div class="col-sm-5">
                <input type="text" class="form-control">
              </div>
              <div class="col-sm-4">
                <button type="button" class="btn btn-primary">Generate</button>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Description</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3"></textarea>
              </div>
            </div>

            <div class="text-right">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>

@endsection
