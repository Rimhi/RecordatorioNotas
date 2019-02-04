@extends('layouts.app')
@section('titulo','registro')
@section('content')
		
		@if(session()->has('info'))
		<h3>{{session('info')}}</h3>
		@else
	 <form method="POST" action="{{ route('nota.store') }}" class="form_nota">
                        @csrf
                        <div class="form-group row">
                        	<label class="col-md-8 col-form-label text-md-right"><h1>Agregar Notas</h1></label>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

                            <div class="col-md-6">
                                <textarea id="descripcion" type="textarea" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="descripcion" value="{{ old('name') }}" required ></textarea>

                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de fin') }}</label>

                            <div class="col-md-6">
                                <input id="fecha_final" type="date" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="fecha_final" value="{{ old('name') }}" required >

                                @if ($errors->has('date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Responsable') }}</label>
                            <div class="col-md-6">
                                @if(!auth()->user()->hasRole(['admin']))
                                    <input type="text" name="" class="form-control" value="{{ Auth::user()->name }}" disabled>
                                @else
                                    <input type="text" name="" class="form-control" value="{{ Auth::user()->name }}">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                             <div class="col-md-6 ">
                                 <input type="text" name="estado" id="estado" class="form-control" placeholder="Estado" required>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Categorias') }}</label>
                             <div class="col-md-6 offset-md-4">
                                 <ul class="list-group">
                                        @foreach($categorias as $categoria)
                                            <li class="list-group-item">
                                             <a>{{$categoria->categoria}}</a><input type="checkbox" class="btn-block" name="categoria" value="{{$categoria->id}}">
                                            </li>
                                        @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Colaboradores') }}</label>
                             <div class="col-md-6 offset-md-4">
                                 <ul class="list-group">
                                        @foreach($usuarios as $usuario)
                                            <li class="list-group-item">
                                             <a>{{$usuario->name}}</a><input type="checkbox" class="btn-block" name="colaborador" value="{{$usuario->id}}">
                                            </li>
                                        @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                 <div class="container">
                                    <div class="content">
                                        <div class="send">
                                            <div class="send-indicator">
                                                <div class="send-indicator-dot"></div>
                                                <div class="send-indicator-dot"></div>
                                                <div class="send-indicator-dot"></div>
                                                <div class="send-indicator-dot"></div>
                                            </div>
                                            <button class="send-button" type="submit" id="enviar">
                                                <div class="sent-bg"></div>
                                                <i class="fa fa-send send-icon"></i>
                                                <i class="fa fa-check sent-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="800">
                                      <defs>
                                        <filter id="goo">
                                          <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                                          <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
                                          <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
                                        </filter>
                                        <filter id="goo-no-comp">
                                          <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                                          <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
                                        </filter>
                                      </defs>
                                    </svg>
                                </div><!-- /container -->
                                <!--
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Terminado') }}
                                </button>
                            -->
                            </div>
                        </div>
                    </form>
	@endif
@endsection