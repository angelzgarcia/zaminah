@extends('layouts.main-admin')

@section('titulo', 'Zonas Arqueológicas | INAH')

@section('admin-content')

    <div class="zones-content">
        <h1><a href="{{route('admin.database.index')}}">Volver</a></h1>
        <h1><a href="{{route('admin.zones.create')}}">Agregar Zona</a></h1>
        @foreach ($zones as $zone)
            <h2>
                <a href="{{ route('admin.zones.show', $zone) }}">{{$zone->idZonaArqueologica}}.-{{$zone->nombre}}</a>
                <a href="{{ route('admin.zones.edit', $zone) }}">Editar</a>
                <form action="{{route('admin.zones.destroy', $zone)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit">Eliminar</button>
                </form>
            </h2>
        @endforeach
    </div>

    {{$zones->links()}}

@endsection