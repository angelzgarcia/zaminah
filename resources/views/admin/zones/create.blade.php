@extends('layouts.main-admin')

@section('titulo', 'Añadir zona | INAH')

@section('admin-content')

    <form action="{{route('admin.zones.store')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf

        <h2>Agrega una zona arqueologica</h2>
        <fieldset>
            <legend>Nombre</legend>
            <input type="text" name="nombre" value="{{old('nombre')}}">
            @error ('nombre')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Significado</legend>
            <textarea name="significado" id="" cols="30" rows="10">{{old('significado')}}</textarea>
            @error ('significado')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Descripcion</legend>
            <textarea name="descripcion" id="" cols="30" rows="10">{{old('descripcion')}}</textarea>
            @error ('descripcion')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Acceso</legend>
            <textarea name="acceso" id="" cols="30" rows="10">{{old('acceso')}}</textarea>
            @error ('acceso')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Horario</legend>
            <label for="de_dia">De:</label>
            <select name="de_dia" id="de_dia" value="{{old('de_dia')}}">
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miercoles">Miercoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sabado">Sabado</option>
                <option value="Domingo">Domingo</option>
            </select>
            @error ('de_dia')
                <div class="error">{{$message}}</div>
            @enderror

            <label for="a_dia">a:</label>
            <select name="a_dia" id="a_dia" value="{{old('a_dia')}}">
                <option value="Domingo">Domingo</option>
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miercoles">Miercoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sabado">Sabado</option>
            </select>
            @error ('a_dia')
                <div class="error">{{$message}}</div>
            @enderror

            <br><br>
            <label for="de_hora">De las:</label>
            <input type="time" id="hora" name="de_hora" value="{{old('de_hora')}}">
            @error ('de_hora')
                <div class="error">{{$message}}</div>
            @enderror

            <label for="a_hora">a las:</label>
            <input type="time" id="hora" name="a_hora" value="{{old('a_hora')}}">
            @error ('a_hora')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Costo de la entrada</legend>
            <span><strong><em>$</em> </strong></span><input type="text" name="costo" maxlength="4" value="{{old('costo')}}">
            @error ('costo')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <textarea name="contacto" id="" cols="30" rows="10">{{old('contacto')}}</textarea>
            @error ('contacto')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>¿En qué estado de la República Mexicana se encuentra?</legend>
            <select name="estado" id="estado">
                @foreach ($states as $state)
                    <option value="{{old('estado', $state->idEstadoRepublica)}}">{{$state->nombre}}</option>
                @endforeach
            </select>
            @error ('estado')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>¿A qué cultura perteneció esta Zona Arqueológica?</legend>
            <select name="cultura" id="cultura">
                    @foreach ($cultures as $cult)
                        <option value="{{old('cultura', $cult->idCultura)}}">{{$cult->nombre}}</option>
                    @endforeach
            </select>
            @error ('cultura')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Fotos <small>(minimo 2, maximo 4)</small></legend>
            <input type="file" name="fotos[]" id="fotos[]" multiple accept="image/*">
            @error ('fotos')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <button type="submit">Guardar</button>
    </form>

@endsection
