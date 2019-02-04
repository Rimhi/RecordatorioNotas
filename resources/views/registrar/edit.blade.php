@extends('layouts.app')
@section('titulo','editar')
@section('content')
		Editar
	<div id="alert" class="alert alert-info">
		
	</div>
		<!--
		<form method="POST">
			<input type="text" name="name" required>
			<input type="email" name="email" required>
			<input type="email" name="email_verified_at" required>
			<input type="password" name="password" required>
		</form>
		-->
		@if(session()->has('info'))
		<h3>{{session('info')}}</h3>
		@else
	<form method="POST" action="{{route('registro.update',$proyecto->id)}}">
		{!!@method_field('PUT')!!}
		@csrf
		<input type="text" name="nombre" value="{{$proyecto->nombre}}" required>
		<input type="textarea" name="descripcion" value="{{$proyecto->descripcion}}" required>
		<button id="btn-edit">Enviar</button>
	</form>
	@endif
@endsection
