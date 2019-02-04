@extends('layouts.app')
@section('titulo','lista de proyectos')
@section('content')
	<table width="100%" border="1">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Fecha de creacion</th>
				<th>Fecha de modificacion</th>
			</tr>
		</thead>
		<tbody>
			
		<tr>
			<td>{{$proyecto->id}}</td>
			<td>{{$proyecto->nombre}}</td>
			<td>{{$proyecto->descripcion}}</td>
			<td>{{$proyecto->created_at}}</td>
			<td>{{$proyecto->updated_at}}</td>
		</tr>
		</tbody>
	</table>

@endsection