
@extends('layouts.main-admin')

@section('titulo', 'Tabla Culturas | INAH | Admin')

@section('admin-content')

    <h3><a href="{{route('admin.database.index')}}">Volver</a></h3>
    <h3><a href="{{route('admin.cultures.create')}}">Agregar cultura</a></h3>

    @foreach ($culturas as $cultura)
        <h1>
            <span>{{$cultura->idCultura}}</span>
            _
            <a href="{{route('admin.cultures.show', $cultura->idCultura)}}">{{$cultura->nombre}}</a>
            {{-- query strings son los parametros que tiene el metodo route --}}
            <span><small><a href="{{route('admin.cultures.edit', $cultura, 'edit')}}">Editar</a></small></span>
            <form action="{{route('admin.cultures.destroy', $cultura)}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit">Eliminar</button>
            </form>
        </h1>

    @endforeach

    <div class="paginador">
        {{$culturas->links()}}
    </div>

@endsection

