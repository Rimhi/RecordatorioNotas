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
	@endif
@endsection