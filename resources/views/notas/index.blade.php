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
    <div class="container">
        <table class="table table-hover">
          <div id="alert" class="alert alert-info">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Responsable</th>
              <th scope="col">Final</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($notas as $nota)
            @if($nota->users->id == auth()->user()->id)
            @if($now->diffInDays($nota->fecha_final,false)<=3)
               <tr style="background-color: red">
              <td><a href="{{route('nota.show',$nota->id)}}">{{$nota->name}}</a></td>
              <td>{{$nota->descripcion}}</td>
              <td>{{$nota->user->name}}</td>
              <td>{{$nota->created_at->format('Y-m-d')}}</td>
              <td>faltan {{$now->diffInDays($nota->fecha_final,false)}} dias</td>
              <td>
                <a class="btn btn-success" href="{{route('nota.edit',$nota->id)}}">Editar</a>
                <form style="display: inline-block;" method="POST" action="{{route('nota.destroy',$nota->id)}}">
                  @csrf
                  {!!method_field('DELETE')!!}
                  <button class="btn btn-danger">Eliminar</button>
                </form></td>

            </tr>


            @elseif(($now->diffInDays($nota->fecha_final,false)>=4) && ($now->diffInDays($nota->fecha_final,false)<=5))
            <tr style="background-color: orange">
              <td><a href="{{route('nota.show',$nota->id)}}">{{$nota->name}}</a></td>
              <td>{{$nota->user->name}}</td>
              <td>faltan {{$now->diffInDays($nota->fecha_final,false)}} dias</td>
              <td>
                <a class="btn btn-success btn-sm" href="{{route('nota.edit',$nota->id)}}">Editar</a>
                <form style="display: inline-block;" method="POST" action="{{route('nota.destroy',$nota->id)}}">
                  @csrf
                  {!!method_field('DELETE')!!}
                  <button class="btn btn-danger btn-sm">Eliminar</button>
                </form></td>

            </tr>
            @elseif(($now->diffInDays($nota->fecha_final,false)>=6) && ($now->diffInDays($nota->fecha_final,false)<=7))
               <tr style="background-color: yellow">
              <td><a href="{{route('nota.show',$nota->id)}}">{{$nota->name}}</a></td>
              <td>{{$nota->descripcion}}</td>
              <td>{{$nota->user->name}}</td>
              <td>faltan {{$now->diffInDays($nota->fecha_final,false)}} dias</td>
              <td>
                <a class="btn btn-success" href="{{route('nota.edit',$nota->id)}}">Editar</a>
                <form style="display: inline-block;" method="POST" action="{{route('nota.destroy',$nota->id)}}">
                  @csrf
                  {!!method_field('DELETE')!!}
                  <button class="btn btn-danger">Eliminar</button>
                </form></td>

            </tr>
            @else
            <tr class="success">
              <td><a href="{{route('nota.show',$nota->id)}}">{{$nota->name}}</a></td>
              <td>{{$nota->user->name}}</td>
              <td>faltan {{$now->diffInDays($nota->fecha_final,false)}} dias</td>
              <td>
                <a class="btn btn-success btn-sm" href="{{route('nota.edit',$nota->id)}}">Editar</a>
                <form style="display: inline-block;" method="POST" action="{{route('nota.destroy',$nota->id)}}">
                  @csrf
                  {!!method_field('DELETE')!!}
                  <button class="btn btn-danger btn-sm ">Eliminar</button>
                </form></td>

            </tr>
            @endif
            @endif
            @endforeach
          </tbody>
        </table>
</div>
    @endif
   
@endsection