@extends('layouts.main-admin')

@section('titulo', 'Estados de la República | INAH')

@section('admin-content')

    <h2><a href="{{route('admin.database.index')}}">Volver</a></h2>
    @foreach ($states_locations as $s_l)
        <p>
            Latitud <br>
            {{$s_l->latitud}}
        </p>
        <p>
            longitud <br>
            {{$s_l->longitud}}
        </p>
    @endforeach

    {{$states_locations->links()}}

@endsection
