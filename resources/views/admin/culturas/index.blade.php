
@extends('layouts.main-admin')

@section('titulo', 'Tabla Culturas | INAH | Admin')

@section('admin-content')

    @foreach ($culturas as $cultura)

        <h1>
            <span>{{$cultura->idCultura}}</span>
            _
            <a href="{{route('admin.cultures.show', $cultura->idCultura)}}">{{$cultura->nombre}}</a>
        </h1>

    @endforeach

    <div class="paginador">
        {{$culturas->links()}}
    </div>

@endsection

