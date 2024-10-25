@extends('layouts.main')

@section('titulo', 'Zonas Arqueológias | INAH')

@section('users-content')
    <h1>Zonas Aqueológicas de México</h1>

    <div class="zones-grid-container">
        @foreach($zonas as $zona)
            <div class="zone-card">
                <strong><a href="{{route('user.zonas.show', $zona)}}">{{$zona->nombre}}</a></strong>
            </div>
        @endforeach
    </div>

    {{$zonas->links()}}
@endsection
