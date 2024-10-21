@extends('layouts.main-admin')

@section('titulo')
    Estado de {{$state->nombre}} | INAH
@endsection

@section('admin-content')

    <h2><a href="{{route('admin.estados.index')}}">Volver a los estados</a></h2>
    <h2><a href="{{route('admin.estados.edit', $state)}}">Editar</a></h2>
    <form action="{{route("admin.estados.destroy", $state)}}" method="POST">
        @csrf
        @method('delete')
        <button type="submit">Eliminar</button>
    </form>
    <h1>HAZ BUSCADO EL ESTADO<em><big>{{$state->idEstadoRepublica}} | "{{$state->nombre}}"</big></em></h1>
    <p>{{$state->capital}}</p>
    <img src="{{ img_u_url($state->foto)}}" width="300px" alt="cultura">

@endsection
