@extends('layouts.app')
@section('titulo','registro')
@section('content')
		Registro
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
	<form method="POST" action="{{route('registro.store')}}">
		@csrf
		<input type="text" name="nombre" value="{{old('nombre')}}"required>
		<input type="textarea" name="descripcion" value="{{old('descripcion')}}" required>
		<button>Enviar</button>
	</form>
	@endif
@endsection