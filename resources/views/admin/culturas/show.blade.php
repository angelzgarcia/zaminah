
@extends('layouts.main-admin')

@section('titulo')
    Cultura {{$cultura->nombre}} | INAH | Admin
@endsection

@section('admin-content')

    <a href="{{route('admin.cultures.index')}}">Volver a las culturas</a>
    <h1>HAZ BUSCADO LA CULTURA <em><big>{{$cultura->idCultura}} | "{{$cultura->nombre}}"</big></em></h1>
    <p>{{$cultura->descripcion}}</p>

@endsection
