@extends('layouts.main-admin')

@section('titulo', 'Editar estado | INAH')

@section('admin-content')

    <form action="{{route('admin.states.update', $state)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <h2>Editar estado</h2>
        <fieldset>
            <legend>Nombre</legend>
            <input type="text" name="nombre" value="{{old('nombre', $state->nombre)}}">
            @if ($errors -> has('nombre'))
                <div class="error">{{ $errors -> first('nombre') }}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Capital</legend>
            <input type="text" name="capital" id="" value="{{old('capital', $state->capital)}}">
            @if ($errors -> has(''))
                <div class="error">{{$errors -> first('')}}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Foto</legend>
            <input type="file" name="foto" id="foto" accept="image/*">
            <div>
                <img src="{{img_u_url($state->foto)}}" alt="estado">
            </div>
            @if ($errors -> has(''))
                <div class="error">{{$errors -> first('')}}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Video (Ingresa la URL del video)</legend>
            <input type="text" name="video" id="" value="{{old('video', $state->video)}}">
            @error ('')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Triptico</legend>
            <input type="file" name="triptico">
            <input type="text" name="" id="" value="{{old('triptico', basename(triptico_url($state->triptico)))}}" disabled>
            @if ($errors -> has('triptico'))
                <div class="error">{{$errors -> first('triptico')}}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Guia</legend>
            <input type="file" name="guia">
            <input type="text" name="" id="" value="{{old('guia', basename(guia_url($state->guia)))}}" disabled>
            @if ($errors -> has('guia'))
                <div class="error">{{$errors -> first('guia')}}</div>
            @endif
        </fieldset>

        <button type="submit">Guardar</button>
    </form>
@endsection
