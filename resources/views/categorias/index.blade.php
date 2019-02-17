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
			      <th scope="col">Categoria</th>
			      <th scope="col">Descripcion</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($categorias as $categoria)
			    <tr>
			      <th scope="row">{{$categoria->id}}</th>
			      <td>{{$categoria->categoria}}</td>
			      <td>{{$categoria->descripcion}}</td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>
		</div>
		<div class="col-md-4">
			<form method="POST" action="{{ route('categoria.store') }}">
				 @csrf
  				<div class="form-group">
   					<label for="exampleFormControlInput1">Categoria</label>
    				<input type="text" class="form-control" id="name" name="name" placeholder="Ejemplo: Docente" required>
 		 		</div>
 		 		<div class="form-group">
    				<label for="exampleFormControlTextarea1">Descripcion</label>
   					<textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
  				</div>
 		 		<button type="submit" class="btn btn-outline-primary btn-block">Agregar</button>
			</form>
		</div>
	</div>
	</div>
		
	@endif
@endsection