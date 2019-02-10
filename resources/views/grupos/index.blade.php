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
			      <th scope="col">Grupo</th>
			      <th scope="col">Integrantes</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($grupos as $grupo)
			    <tr>
			      <th scope="row">{{$grupo->id}}</th>
			      <th>{{$grupo->nombre}}</th>

			      <td>
			      	@foreach($grupo->users as $integrante)
			      	{{$integrante->name}} -
			      	@endforeach
			      </td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>
		</div>
		<div class="col-md-4">
			<form method="POST" action="{{ route('grupo.store') }}">
				 @csrf
  				<div class="form-group">
   					<label for="exampleFormControlInput1">Nombre del grupo</label>
    				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ejemplo: Grupo #1" required>
 		 		</div>
 		 	 	<div class="form-group">
    				<label for="exampleFormControlSelect2">Usuarios</label>
    				<select multiple   class="form-control" id="user_id" name="user_id[]">
    					@foreach($usuarios as $id => $name)
      					<option value="{{$id}}">{{$name}}</option>
      					@endforeach
    				</select>
  				</div>
 		 		<button type="submit" class="btn btn-outline-primary btn-block">Agregar</button>
			</form>
		</div>
	</div>
	</div>	
	@endif
@endsection