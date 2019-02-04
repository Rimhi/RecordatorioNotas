@extends('layouts.app')
@section('titulo','lista de proyectos')
@section('content')
	<p>
		<span id="proyectos">
			{{$proyecto->total()}} Registros 
		</span>| 
		pagina{{$proyecto->currentPage()}}
		de {{$proyecto->lastPage()}}
	</p>
	<div id="alert" class="alert alert-info">
		
	</div>
	<table width="100%" border="1">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Fecha de creacion</th>
				<th>Fecha de modificacion</th>
				<th>Autor</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($proyecto as $proyec)
		<tr>
			<td>{{$proyec->id}}</td>
			<td><a href="{{route('registro.show',$proyec->id)}}">{{$proyec->nombre}}</a></td>
			<td>{{$proyec->descripcion}}</td>
			<td>{{$proyec->created_at}}</td>
			<td>{{$proyec->updated_at}}</td>
			<td>{{$proyec->user->name}}</td>
			@if($proyec->user_id === $id || auth()->user()->hasRole(['admin']))
			<td><a href="{{route('registro.edit',$proyec->id)}}">Editar</a>
				<form style="display: inline-block;" method="POST" action="{{route('registro.destroy',$proyec->id)}}">
					@csrf
					{!!method_field('DELETE')!!}
					<button class="btn-delete">Eliminar</button>
				</form>
		</td>
		@endif
		</tr>
		@endforeach
		</tbody>
	</table>
	{!!$proyecto->render()!!}

@endsection
