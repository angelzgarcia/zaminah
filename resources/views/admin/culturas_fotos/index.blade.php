@extends('layouts.main-admin')

@section('titulo', 'Estados de la República | INAH')

@section('admin-content')

    <h2><a href="{{route('admin.database.index')}}">Volver</a></h2>
    @foreach ($cultures_images as $c_i)
        <p>
            Foto <br>
            <img src="{{img_u_url($c_i->foto)}}" width="300px" alt="review_image">
        </p>
        <p>
            idCultura <br>
            {{$c_i->idCultura}}
        </p>
    @endforeach

    {{$cultures_images->links()}}

@endsection
