@extends('layouts.main-admin')

@section('titulo', 'Zonas Arqueológicas | INAH')

@section('admin-content')

    <div class="zones-content">
        <h1><a href="{{route('admin.database.index')}}">Volver</a></h1>
        <h1><a href="{{route('admin.usuarios.create')}}">Agregar Administrador</a></h1>
        @foreach ($users as $user)
            <h2>
                <a href="{{ route('admin.usuarios.show', $user) }}">{{$user->idUsuario}}.-{{$user->nombre}}</a>
                <a href="{{ route('admin.usuarios.edit', $user) }}">Editar</a>
            </h2>
        @endforeach
    </div>

    {{$users->links()}}

@endsection
