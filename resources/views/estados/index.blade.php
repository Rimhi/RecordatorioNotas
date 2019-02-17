@extends('layouts.app')
@section('titulo','registro')
@section('content')
		@if(session()->has('info'))
		<h3>{{session('info')}}</h3>
		@else
		<div class="container">
		<div class="row">
		<div class="col-md-7">
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Estado</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($estados as $estado)
			    <tr>
			      <th scope="row">{{$estado->id}}</th>
			      <td>{{$estado->estado}}</td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>
		</div>
		<div class="col-md-4">
			<form method="POST" action="{{ route('estado.store') }}">
				 @csrf
  				<div class="form-group">
   					<label for="exampleFormControlInput1">Estado</label>
    				<input type="text" class="form-control" id="name" name="name" placeholder="Ejemplo: Pendiente" required>
 		 		</div>
 		 		<button type="submit" class="btn btn-outline-primary btn-block">Agregar</button>
			</form>
		</div>
	</div>
	</div>
		
	@endif
@endsection