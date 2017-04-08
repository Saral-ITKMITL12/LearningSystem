@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css\segmented-controls.css')}}">
<section>
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">Dashboard</div>

                  <div class="panel-body">
                    <div class="segmented-control" style="width: 100%; color: #5FBAAC">
<input type="radio" name="sc-1-1" id="sc-1-1-1">
<input type="radio" name="sc-1-1" id="sc-1-1-2">
<input type="radio" name="sc-1-1" id="sc-1-1-3" checked>
<input type="radio" name="sc-1-1" id="sc-1-1-4">
<label for="sc-1-1-1" data-value="Lorem Ipsum">Lorem Ipsum</label>
<label for="sc-1-1-2" data-value="Risus Purus">Risus Purus</label>
<label for="sc-1-1-3" data-value="Pellentesque Porta">Pellentesque Porta</label>
<label for="sc-1-1-4" data-value="Fringilla">Fringilla</label>
</div>


<div class="segmented-control" style="width: 100%;">
  <input type="radio" name="sc-2-1" id="sc-2-1-1" checked>
  <label for="sc-2-1-1" data-value="Venenatis">Venenatis</label>
</div>
<div class="segmented-control" style="width: 100%;">
  <input type="radio" name="sc-2-1" id="sc-2-1-2">
  <label for="sc-2-1-2" data-value="Malesuada">Malesuada</label>
</div>
<div class="segmented-control" style="width: 100%;">
  <input type="radio" name="sc-2-1" id="sc-2-1-3">
  <label for="sc-2-1-3" data-value="Consectetur">Consectetur</label>
</div>
<div class="segmented-control" style="width: 100%;">
  <input type="radio" name="sc-2-1" id="sc-2-1-4">
  <label for="sc-2-1-4" data-value="Egestas">Egestas</label>
</div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
