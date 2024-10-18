@extends('layouts.main-admin')

@section('titulo', 'Añadir estado | INAH')

@section('admin-content')
    <form action="{{route('admin.states.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <h2>Agrega un estado</h2>
        <fieldset>
            <legend>Nombre</legend>
            <input type="text" name="nombre" value="{{old('nombre')}}">
            @if ($errors -> has('nombre'))
                <div class="error">{{ $errors -> first('nombre') }}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Capital</legend>
            <input type="text" name="capital" id="" value="{{old('capital')}}">
            @if ($errors -> has('capital'))
                <div class="error">{{$errors -> first('capital')}}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Foto</legend>
            <input type="file" name="foto" id="foto" accept="image/*">
            @if ($errors -> has('foto'))
                <div class="error">{{$errors -> first('foto')}}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Video (Ingresa la URL del video)</legend>
            <input type="text" name="video" id="" value="{{old('video')}}">
            @error ('video')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Triptico</legend>
            <input type="file" name="triptico">
            @if ($errors -> has('triptico'))
                <div class="error">{{$errors -> first('triptico')}}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Guia</legend>
            <input type="file" name="guia">
            @if ($errors -> has('guia'))
                <div class="error">{{$errors -> first('guia')}}</div>
            @endif
        </fieldset>

        <button type="submit">Guardar</button>
    </form>
@endsection
