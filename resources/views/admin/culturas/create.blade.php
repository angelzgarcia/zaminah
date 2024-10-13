
@extends('layouts.main-admin')

@section('titulo', 'Agregar cultura | INAH | Admin')

@section('admin-content')

    <h1>AQUÍ SE VAN A PODER AGREGAR CULTURAS</h1>

    {{-- TOKEN GENERADO POR LARAVEL POR SEGURIDAD  --}}
    <form action="{{route('admin.cultures.store')}}" method="POST">
        @csrf
        <h2>Agrega una cultura</h2>
        <fieldset>
            <legend>Nombre</legend>
            <input type="text" name="nombre" value="{{old('nombre')}}">
            @if ($errors -> has('nombre'))
                <div class="error">{{ $errors -> first('nombre') }}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Periodo</legend>
            <textarea name="periodo" id="" cols="30" rows="10"></textarea>
            @if ($errors-> has('periodo'))
                <div class="error">{{$errors->first('periodo')}}</div>
            @endif
        <fieldset>

        <fieldset>
            <legend>Significado</legend>
            <textarea name="significado" id="" cols="30" rows="10"></textarea>
        </fieldset>

        <fieldset>
            <legend>Descripcion</legend>
            <textarea name="descripcion" id="" cols="30" rows="10"></textarea>
        </fieldset>

        <fieldset>
            <legend>Foto</legend>
            <input type="file" name="foto" id="">
        </fieldset>

        <fieldset>
            <legend>Aportaciones</legend>
            <textarea name="aportaciones" id="" cols="30" rows="10"></textarea>
        </fieldset>

        <button type="submit">Guardar</button>
    </form>

@endsection
