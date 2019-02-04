@extends('layouts.app')
@section('titulo','registro')
@section('content')
		
		@if(session()->has('info'))
		<h3>{{session('info')}}</h3>
		@else
			<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Responsable</th>
      <th scope="col">Fecha de Inicio</th>
      <th scope="col">Fecha de Fin</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($notas as $nota)
    <tr>
      <th scope="row">{{$nota->id}}</th>
      <td><a href="{{route('nota.show',$nota->id)}}">{{$nota->name}}</a></td>
      <td>{{$nota->descripcion}}</td>
      <td>{{$nota->user->name}}</td>
      <td>{{$nota->created_at}}</td>
      <td>{{$nota->fecha_final}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
		@endif
@endsection