
@extends('layouts.main-admin')

@section('titulo', 'Añadir estado | INAH')

@section('admin-content')
    <form action="{{route('admin.estados.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <h2>Agrega un estado</h2>

        <fieldset>
            <legend>Nombre</legend>
            <input type="text" name="nombre" value="{{old('nombre')}}">
            @error('nombre')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Capital</legend>
            <input type="text" name="capital" id="" value="{{old('capital')}}">
            @error('capital')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Foto</legend>
            <input type="file" name="foto" id="foto" accept="image/*">
            @error('foto')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Video (Ingresa la URL del video)</legend>
            <input type="text" name="video" id="" value="{{old('video')}}">
            @error('video')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Triptico</legend>
            <input type="file" name="triptico">
            @error('triptico')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Guia</legend>
            <input type="file" name="guia">
            @error('guia')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <button type="submit">Guardar</button>
    </form>
@endsection
