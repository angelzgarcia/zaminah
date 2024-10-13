
@extends('layouts.main-admin')

@section('titulo', 'Tabla Culturas | INAH | Admin')

@section('admin-content')

    @foreach ($culturas as $cultura)

        <h1>{{$cultura->nombre}}</h1>

    @endforeach

    <div class="paginador">
        {{$culturas->links()}}
    </div>

@endsection

