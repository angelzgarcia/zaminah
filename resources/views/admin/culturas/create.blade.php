
@extends('layouts.main-admin')

@section('titulo', 'Agregar cultura | INAH | Admin')

@section('admin-content')

    <h1>AQUÍ SE VAN A PODER AGREGAR CULTURAS</h1>

    {{-- TOKEN GENERADO POR LARAVEL POR SEGURIDAD  --}}
    <form action="{{route('admin.cultures.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Agrega una cultura</h2>
        <fieldset>
            <legend>Nombre</legend>
            <input type="text" name="nombre" value="{{old('nombre')}}" required>
            @if ($errors -> has('nombre'))
                <div class="error">{{ $errors -> first('nombre') }}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Periodo</legend>
            <textarea name="periodo" id="" cols="30" rows="10" required>{{old('periodo')}}</textarea>
            @if ($errors -> has('periodo'))
                <div class="error">{{$errors -> first('periodo')}}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Significado</legend>
            <textarea name="significado" id="" cols="30" rows="10" required>{{old('significado')}}</textarea>
            @if ($errors -> has('significado'))
                <div class="error">{{$errors -> first('significado')}}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Descripcion</legend>
            <textarea name="descripcion" id="" cols="30" rows="10" required>{{old('descripcion')}}</textarea>
            @error ('descripcion')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Foto</legend>
            <input type="file" name="foto" id="foto" required accept="image/*">
            @if ($errors -> has('foto'))
                <div class="error">{{$errors -> first('foto')}}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Aportaciones</legend>
            <textarea name="aportaciones" id="" cols="30" rows="10" required>{{old('aportaciones')}}</textarea>
            @if ($errors -> has('aportaciones'))
                <div class="error">{{$errors -> first('aportaciones')}}</div>
            @endif
        </fieldset>

        <button type="submit">Guardar</button>
    </form>

@endsection
