@extends('layouts.app')
@section('titulo','registro')
@section('content')
		
		@if(session()->has('info'))
		<h3>{{session('info')}}</h3>
		@else

    {{ Form::open(['route'=>'nota.index','method'=>'GET','class'=>'form-inline pull-right']) }}
    <div class="form-group">
      {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Buscar nota...','id'=>'buscar']) }}
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">
       Buscar
      </button>
    </div>
    {{ Form::close() }}
<table class="table">
  <div id="alert" class="alert alert-info">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Responsable</th>
      <th scope="col">Fecha de Inicio</th>
      <th scope="col">Fecha de Fin</th>
      <th scope="col">Opciones</th>
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
      <td>
        <a class="btn btn-success" href="{{route('nota.edit',$nota->id)}}">Editar</a>
        <form style="display: inline-block;" method="POST" action="{{route('nota.destroy',$nota->id)}}">
          @csrf
          {!!method_field('DELETE')!!}
          <button class="btn btn-danger">Eliminar</button>
        </form></td>

    </tr>
    @endforeach
  </tbody>
</table>
		@endif
   
@endsection