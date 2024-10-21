@extends('layouts.main-admin')

@section('titulo', 'Estados de la República | INAH')

@section('admin-content')

    <h2><a href="{{route('admin.database.index')}}">Volver</a></h2>
    @foreach ($zones_images as $z_i)
        <p>
            Foto <br>
            <img src="{{img_u_url($z_i->foto)}}" width="300px" alt="zone_image">
        </p>
        <p>
            idZonaArqueologica <br>
            {{$z_i->idZonaArqueologica}}
        </p>
    @endforeach

    {{$zones_images->links()}}

@endsection
