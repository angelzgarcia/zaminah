@extends('layouts.main-admin')

@section('titulo', 'Estados de la República | INAH')

@section('admin-content')

    <h2><a href="{{route('admin.database.index')}}">Volver</a></h2>
    @foreach ($roles as $rol)
        <p>
            {{$rol->idRol}}.-{{$rol->tipo}}
        </p>
    @endforeach

    {{$roles->links()}}

@endsection
