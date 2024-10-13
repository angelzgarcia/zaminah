
@extends('layouts.main-admin')

@section('titulo', 'Editar | INAH | Admin')

@section('admin-content')
    <h2><a href="{{route('admin.cultures.index')}}">Volver a las culturas</a></h2>
    <h1>VAS A EDITAR LA CULTURA <em><big>"{{$cultura->idCultura}}"</big></em></h1>
    <img src="{{ img_u_url($cultura->foto) }}" alt="cultura">
@endsection
