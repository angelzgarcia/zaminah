@extends('layouts.main-admin')

@section('titulo', 'Estados de la República | INAH')

@section('admin-content')

    <h2><a href="{{route('admin.database.index')}}">Volver</a></h2>
    @foreach ($reviews_images as $r_i)
        <p>
            Foto <br>
            <img src="{{img_u_url($r_i->foto)}}" width="300px" alt="review_image">
        </p>
        <p>
            idReseña <br>
            {{$r_i->idResenia}}
        </p>
    @endforeach

    {{$reviews_images->links()}}

@endsection
