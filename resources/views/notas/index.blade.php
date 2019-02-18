@extends('layouts.app')
@section('titulo','registro')
@section('content')
    
    @if(session()->has('info'))
    <h3>{{session('info')}}</h3>
    @else
 <div class="container" style="margin-bottom: 25px">
      <div class="row">
    {{ Form::open(['route'=>'nota.index','method'=>'GET','class'=>'form-inline pull-right']) }}
    <div class="form-group">
      {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Buscar nota...','id'=>'buscar']) }}
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-outline-primary" style="margin-left: 10px;">
       Buscar
      </button>
    </div>
  </div>
</div>
    {{ Form::close() }}
     <div class="container">
      <div class="row">
          <div class="card-columns">
            @foreach($notas as $nota)
            @foreach($nota->users as $user)
            @if($user->id == auth()->user()->id || auth()->user()->id == $nota->user->id)
            @if($now->diffInDays($nota->fecha_final,false)<=3)
            <div class="card border-danger mb-3" style="max-width: 18rem;">
              <div class="card-header">Responsable: {{$nota->user->name}}</div>
              <div class="card-body text-primary">
                <h5 class="card-title"><a href="{{route('nota.show',$nota->id)}}">{{$nota->name}}</a></h5>
                <p class="card-text">Integrantes: @foreach($nota->users as $integrante)
                  {{$integrante->name}} -
                  @endforeach
                  
                </p>
                <p class="card-text"><div class="container row"><a class="btn btn-success" href="{{route('nota.edit',$nota->id)}}">Editar</a>
                <form style="display: inline-block;" method="POST" action="{{route('nota.destroy',$nota->id)}}">
                  @csrf
                  {!!method_field('DELETE')!!}
                  <button class="btn btn-danger">Eliminar</button>
                </form></div></p>
                <p class="card-text"><small class="text-muted">faltan {{$now->diffInDays($nota->fecha_final,false)}} dias</small></p>
              </div>
            </div>
            @elseif(($now->diffInDays($nota->fecha_final,false)>=4) && ($now->diffInDays($nota->fecha_final,false)<=5))
             <div class="card border-warning mb-3" style="max-width: 18rem;">
              <div class="card-header">Responsable: {{$nota->user->name}}</div>
              <div class="card-body text-primary">
                <h5 class="card-title"><a href="{{route('nota.show',$nota->id)}}">{{$nota->name}}</a></h5>
                <p class="card-text">Integrantes: @foreach($nota->users as $integrante)
                  {{$integrante->name}} -
                  @endforeach
                  
                </p>
                <p class="card-text"><div class="container row"><a class="btn btn-success" href="{{route('nota.edit',$nota->id)}}">Editar</a>
                <form style="display: inline-block;" method="POST" action="{{route('nota.destroy',$nota->id)}}">
                  @csrf
                  {!!method_field('DELETE')!!}
                  <button class="btn btn-danger">Eliminar</button>
                </form></div></p>
                <p class="card-text"><small class="text-muted">faltan {{$now->diffInDays($nota->fecha_final,false)}} dias</small></p>
              </div>
            </div>
            @elseif(($now->diffInDays($nota->fecha_final,false)>=6) && ($now->diffInDays($nota->fecha_final,false)<=7))
            <div class="card border-info mb-3" style="max-width: 18rem;">
              <div class="card-header">Responsable: {{$nota->user->name}}</div>
              <div class="card-body text-primary">
                <h5 class="card-title"><a href="{{route('nota.show',$nota->id)}}">{{$nota->name}}</a></h5>
                <p class="card-text"><div class="container row"><a class="btn btn-success" href="{{route('nota.edit',$nota->id)}}">Editar</a>
                <form style="display: inline-block;" method="POST" action="{{route('nota.destroy',$nota->id)}}">
                  @csrf
                  {!!method_field('DELETE')!!}
                  <button class="btn btn-danger">Eliminar</button>
                </form></div></p>
                <p class="card-text"><small class="text-muted">faltan {{$now->diffInDays($nota->fecha_final,false)}} dias</small></p>
              </div>
            </div>
            @else
            <div class="card border-succes mb-3" style="max-width: 18rem;">
              <div class="card-header">Responsable: {{$nota->user->name}}</a></div>
              <div class="card-body text-primary">
                <h5 class="card-title"><a href="{{route('nota.show',$nota->id)}}">{{$nota->name}}</a></h5>
                <p class="card-text">Integrantes: @foreach($nota->users as $integrante)
                  {{$integrante->name}} -
                  @endforeach
                  
                </p>
                <p class="card-text"><div class="container row"><a class="btn btn-success" href="{{route('nota.edit',$nota->id)}}">Editar</a>
                <form style="display: inline-block;" method="POST" action="{{route('nota.destroy',$nota->id)}}">
                  @csrf
                  {!!method_field('DELETE')!!}
                  <button class="btn btn-danger">Eliminar</button>
                </form></div></p>
                <p class="card-text"><small class="text-muted">faltan {{$now->diffInDays($nota->fecha_final,false)}} dias</small></p>
              </div>
            </div>
            @endif
            @endif
            @endforeach
            @endforeach
        </div>
        </div>
      
    </div>
</div>
    @endif
   
@endsection