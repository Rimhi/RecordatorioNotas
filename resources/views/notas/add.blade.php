@extends('layouts.app')
@section('titulo','registro')
@section('content')
		
		@if(session()->has('info'))
		<h3>{{session('info')}}</h3>
		@else
	 <form method="POST" action="{{ route('nota.store') }}" class="form_nota">
                        @csrf
                        <div class="container">
                        <div class="form-group row">
                        	<label class="col-md-8 col-form-label text-md-right"><h1>Agregar Notas</h1></label>
                        </div>
                            <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Responsable') }}</label>
                            <div class="col-md-6">
                                @if(!auth()->user()->hasRole(['admin']))
                                    <input type="text" name="user_id" id="user_id" class="form-control" value="{{ Auth::user()->name }}" disabled>
                                @else
                                    <select class="form-control" name="user_id" id="user_id">
                                        @foreach($grupo->users as $integrante)
                                            <li class="list-group-item">
                                            <option id="grupos" value="{{$integrante->id}}">{{$integrante->name}}</option>
                                            </li>
                                        @endforeach
                                        
                               </select>
                                @endif
                            </div>
                        </div>
                        <input type="text" name="grupo_id" id="grupo_id" class="form-control" value="{{ $id }}" hidden>
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
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de inicio') }}</label>

                            <div class="col-md-6">
                                <input id="created_at" type="date" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="created_at" value="{{ old('name') }}" required >

                                @if ($errors->has('date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                             <div class="col-md-6 ">
                                <select class="form-control" name="estado_id" id="estado">
                                    @foreach($estados as $estado)
                                     <option  value="{{$estado->id}}">{{$estado->estado}}</option>
                                     @endforeach
                                </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
                             <div class="col-md-6 offset-md-4">
                                    <select class="form-control" name="categoria_id" id="categoria" >
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Colaboradores') }}</label>
                             <div class="col-md-6 offset-md-4">
                               <select class="form-control selectpicker" id="colaborador" name="colaborador[]" data-live-search="true" multiple>
                                        @foreach($grupo->users as $integrante)
                                            <option value="{{$integrante->id}}">{{$integrante->name}}</option>
                                        @endforeach
                                        
                               </select>
                        </div>
                    </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Terminado') }}
                                </button>
                            
                            </div>
                        </div>
                    </form>
	@endif
@endsection
@section('script')
    <script type="text/javascript" href="{{asset('js/integrantes.js')}}"></script>
@endsection