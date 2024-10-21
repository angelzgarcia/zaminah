@extends('layouts.main-admin')

@section('titulo')
    Zona Arqueológica {{$zone->nombre}} | INAH
@endsection

@section('admin-content')

    <h2><a href="{{route('admin.zonas.index')}}">Volver a las zonas</a></h2>
    <h2><a href="{{route('admin.zonas.edit', $zone)}}">Editar</a></h2>
    <form action="{{route("admin.zonas.destroy", $zone)}}" method="POST">
        @csrf
        @method('delete')
        <button type="submit">Eliminar</button>
    </form>
    <h1>HAZ BUSCADO LA ZONA<em><big>{{$zone->idZonaArqueologica}} | "{{$zone->nombre}}"</big></em></h1>
    <p>{{$zone->significado}}</p>
    {{-- <img src="{{ img_u_url($state->foto)}}" width="300px" alt="cultura"> --}}

@endsection
