@extends('layouts.main-admin')

@section('titulo', 'Estados de la República | INAH')

@section('admin-content')

    <h2><a href="{{route('admin.database.index')}}">Volver</a></h2>
    @foreach ($zones_locations as $z_l)
        <p>
            Latitud <br>
            {{$z_l->latitud}}
        </p>
        <p>
            longitud <br>
            {{$z_l->longitud}}
        </p>
    @endforeach

    {{$zones_locations->links()}}

@endsection
