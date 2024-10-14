
@extends('layouts.main-admin')

@section('titulo', 'Editar | INAH | Admin')

@section('admin-content')
    <h2><a href="{{route('admin.cultures.index')}}">Volver a las culturas</a></h2>
    <h1>VAS A EDITAR LA CULTURA <em><big>"{{$culture->idCultura}}"</big></em></h1>

    <form action="{{route('admin.cultures.update', $culture->idCultura)}}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('put')

        <fieldset>
            <legend>Nombre</legend>
            <input type="text" name="nombre" value="{{$culture->nombre}}" required>
            @if ($errors -> has('nombre'))
                <div class="error">{{ $errors -> first('nombre') }}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Periodo</legend>
            <textarea name="periodo" id="" cols="30" rows="10" required>{{$culture->periodo}}</textarea>
            @if ($errors -> has('periodo'))
                <div class="error">{{$errors -> first('periodo')}}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Significado</legend>
            <textarea name="significado" id="" cols="30" rows="10" required>{{$culture->significado}}</textarea>
            @if ($errors -> has('significado'))
                <div class="error">{{$errors -> first('significado')}}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Descripcion</legend>
            <textarea name="descripcion" id="" cols="30" rows="10" required>{{$culture->descripcion}}</textarea>
            @error ('descripcion')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Foto</legend>
            <input type="file" name="foto" id="foto" accept="image/*">
            <div class="img-edit-old">
                <img src="{{img_u_url($culture->foto)}}" alt="foto">
            </div>
            @if ($errors -> has('foto'))
                <div class="error">{{$errors -> first('foto')}}</div>
            @endif
        </fieldset>


        <fieldset>
            <legend>Aportaciones</legend>
            <textarea name="aportaciones" id="" cols="30" rows="10" required>{{$culture->aportaciones}}</textarea>
            @if ($errors -> has('aportaciones'))
                <div class="error">{{$errors -> first('aportaciones')}}</div>
            @endif
        </fieldset>

        <button type="submit">Guardar cambios</button>
    </form>
@endsection
