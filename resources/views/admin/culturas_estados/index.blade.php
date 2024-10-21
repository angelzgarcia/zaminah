@extends('layouts.main-admin')

@section('titulo', 'Estados de la República | INAH')

@section('admin-content')

    <h2><a href="{{route('admin.database.index')}}">Volver</a></h2>
    @foreach ($cultures_states as $c_s)
        <p>
            idCulturaEstado.- {{$c_s->idCulturaEstado}}
        </p>
        <p>
            idCultura.- {{$c_s->idCultura}}
        </p>
        <p>
            idEstado.- {{$c_s->idEstadoRepublica}}
        </p>
    @endforeach

    {{$cultures_states->links()}}

@endsection
