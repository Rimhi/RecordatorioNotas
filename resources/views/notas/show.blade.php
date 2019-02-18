@extends('layouts.app')
@section('content')
		<div id="alert" class="alert alert-info">
        </div>
		@if(session()->has('info'))
		<h3>{{session('info')}}</h3>
		@else
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<h1>{{$nota->name}}</h1>
						</div>
						<p>
							{{$nota->descripcion}}	
							
						</p>
						<p>Responsable: {{$nota->user->name}}</p>
						<p>Colaborador: {{$nota->grupo->nombre}}</p>
						<p>Integrantes: 
						@foreach($nota->users as $integrante)
			      		{{$integrante->name}} -
			      		@endforeach
						</p>
						<P>Fecha Inicio: {{$nota->created_at}}</P>
						<P>Fecha fin: {{$nota->fecha_final}}</P>
						<p>Ultima actualizacion {{$nota->updated_at}}</p>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<h4>Comentarios</h4>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<form  method="POST" action="{{ route('comentario.store') }}">
						 @csrf
						<input type="text" name="nota_id" value="{{$nota->id}}" hidden required>
						<input type="text" name="user_id" value="{{auth()->user()->id}}" hidden required>
						<input type="text" name="comentario" class="form-control" placeholder="Escribe tu comentario!" required>
						<button type="submit" class="btn btn-outline-primary" style="margin-top: 10px;">Enviar Comentario!</button>
					</form>
				</div>
			</div>
			<div class=" container" style="margin-top: 30px;">
				<div class="row">
				<div class="list-group">
				@foreach($comentarios as $comentario)
				@if($comentario->nota->pluck('id'))
				  <a href="#" class="list-group-item list-group-item-action" style="margin-bottom:5px">
				    <div class="d-flex w-100 justify-content-between">
				      <h5 class="mb-1">{{$comentario->user->name}}</h5>
				      <small>Hace {{$comentario->created_at->diffInDays($now)}} dias</small>
				    </div>
				    <p class="mb-1">{{$comentario->comentario}}</p>
				    <small>Actualizado en: {{$comentario->updated_at}}</small>
				  </a>
				  @endif
				  @endforeach
				</div>
				</div>

			</div>
	@endif
@endsection