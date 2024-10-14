
@extends('layouts.main-admin')

@section('titulo')
    Cultura {{$culture->nombre}} | INAH | Admin
@endsection

@section('admin-content')

    <h2><a href="{{route('admin.cultures.index')}}">Volver a las culturas</a></h2>
    <h2><a href="{{route('admin.cultures.edit', $culture->idCultura)}}">Editar</a></h2>

    <h1>HAZ BUSCADO LA CULTURA <em><big>{{$culture->idCultura}} | "{{$culture->nombre}}"</big></em></h1>
    <img src="{{img_u_url($culture->foto)}}" alt="cultura">
    <p>{{$culture->descripcion}}</p>

@endsection
