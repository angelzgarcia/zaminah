
@extends('layouts.main-admin')

@section('titulo', 'Crear Administrador')

@section('admin-content')
    <form action="{{route('admin.usuarios.store')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf

        <h2>Agrega un Administrador</h2>
        <fieldset>
            <legend>Nombre completo</legend>
            <input type="text" name="nombre" value="{{old('nombre')}}">
            @error ('nombre')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Genero</legend>
            <select name="genero" id="">
                <option value="genero" selected disabled>M / F</option>
                <option value="masculino" {{old('genero') == 'masculino' ? 'selected' : ''}}>Masculino</option>
                <option value="femenino" {{old('genero') == 'femenino' ? 'selected' : ''}}>Femenino</option>
            </select>
            @error ('genero')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Foto</legend>
            <input type="file" name="foto" id="" accept="image/*">
            @error ('foto')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Email</legend>
            <input type="email" name="email" id="" value="{{old('email')}}">
            @error ('email')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Número de celular</legend>
            <div>
                <img src="{{img_d_url('mexico-icon-512x384-tng9bcfk.png')}}" width="30px" height="20px" alt="lada">
                <span>+52</span>
                <input type="tel" name="numero" id="" value="{{old('numero')}}" maxlength="15">
            </div>
            @error ('numero')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        {{-- <fieldset>
            <legend>Contraseña temporal</legend>
            <input type="password" name="password" id="pass" value="{{old('pass')}}">
            @error ('password')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Confirmar contraseña</legend>
            <input type="password" name="conf_password" id="conf_pass" value="{{old('conf_pass')}}">
            @error ('conf_password')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset> --}}

        <button type="submit">Guardar</button>
    </form>
@endsection
