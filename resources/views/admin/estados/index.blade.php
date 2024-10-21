@extends('layouts.main-admin')

@section('titulo', 'Estados de la República | INAH')

@section('admin-content')

    <div class="states-registers-container">
        <h2><a href="{{route('admin.database.index')}}">Volver</a></h2>
        <h2><a href="{{route('admin.estados.create')}}">Añadir estado</a></h2>
        @foreach ($states as $state)
            <p>
                {{$state->idEstadoRepublica}}.-<a href="{{route('admin.estados.show', $state)}}">{{$state->nombre}}</a>
            </p>
        @endforeach
    </div>

    {{$states->links()}}

@endsection
