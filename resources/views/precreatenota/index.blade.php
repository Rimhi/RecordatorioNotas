@extends('layouts.app')
@section('titulo','registro')
@section('content')
		
		@if(session()->has('info'))
		<h3>{{session('info')}}</h3>
		@else
        <div class="container">
    		<form method="POST" action="{{route('precreatenota.enviar')}}">
    			@csrf
    		    <div class="form-group">
               <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Elige tu grupo!') }}</label>
                  <div class="col-md-6 offset-md-4">
                    <select class="form-control" id="colaborador" name="colaborador">
                       @foreach($grupos as $id => $nombre)
                          @if($user->grupos->pluck('id')->contains($id))
                             <li class="list-group-item">
                                <option id="grupos" value="{{$id}}">{{$nombre}}</option>
                              </li>
                          @endif
                        @endforeach
                    </select>
                  </div>
                   <div class="col-md-6 offset-md-4">
                        <button class="btn btn-outline-primary btn-block">Enviar</button>
                  </div>
        </form>
    </div>
  @endif
@endsection