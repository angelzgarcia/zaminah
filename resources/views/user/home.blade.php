
@extends('layouts.main')

@section('titulo', 'INAH | Zonas Arqueológicas de México')

@section('users-content')

    <div class="home-container">
        <div class="zonas-home">
            <h2>
                <a href="{{route('user.zonas.index')}}">
                    Zonas arqueológicas
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
            </h2>
        </div>
        <div class="estados-home">
            <h2>
                <a href="{{route('user.estados.index')}}">
                    Estados de la república
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
            </h2>
        </div>
        <div class="culturas-home">
            <h2>
                <a href="{{route('user.estados.index')}}">
                    Culturas de México
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
            </h2>
        </div>
    </div>

@endsection
