@extends('layouts.app')

@section('content')


<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Correo</th>
      <th scope="col">Rol</th>
      <th scope="col">Fecha creacion</th>
      <th scope="col">Ultima actualizacion</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($users as $user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td><a href="{{route('usuario.edit',$user->id)}}">{{$user->name}}</a></td>
      <td>{{$user->email}}</td>
      <td>{{$user->role->display_name}}</td>
      <td>{{$user->created_at}}</td>
      <td>{{$user->updated_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

	
@endsection
