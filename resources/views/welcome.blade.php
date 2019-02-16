@extends('layouts.app')
@section('titulo','Inicio')
@section('content')
		@if(auth()->check())
			@if(auth()->user()->hasRole(['admin']))
				<div><h1>Admin</h1></div>
			@endif
			@if(auth()->user()->hasRole(['user']))
				<div><h1>Usuario</h1></div>
			@endif
		@endif
		
@endsection