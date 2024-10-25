
@extends('layouts.main')

@section('titulo', 'INAH | Zonas Arqueológicas de México')

@section('users-content')

    <div class="home-container">
        <div class="zonas-home">
            <h2><a href="{{route('user.zonas.index')}}">Zonas arqueológicas</a></h2>
        </div>
        <div class="estados-home">
            <h2><a href="{{route('user.estados.index')}}">Estados de la república</a></h2>
        </div>
        <div class="culturas-home">
            <h2><a href="{{route('user.estados.index')}}">Culturas de México</a></h2>
        </div>
    </div>

@endsection
