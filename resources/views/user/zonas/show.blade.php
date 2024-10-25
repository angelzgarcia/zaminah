@extends('layouts.main')

@section('titulo')
    Zona Arqueológica {{$zona->nombre}} | INAH
@endsection

@section('users-content')
    <h1>Zona Arqueológica {{$zona->nombre}}</h1>
@endsection
