@extends('layouts.main-admin')

@section('titulo', 'Editar zona | INAH')

@section('admin-content')

    <form action="{{route('admin.zones.update', $zone)}}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('put')

        <h2>Editar zona arqueológica {{$zone->nombre}}</h2>
        <fieldset>
            <legend>Nombre</legend>
            <input type="text" name="nombre" value="{{old('nombre', $zone->nombre)}}">
            @error ('nombre')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Significado</legend>
            <textarea name="significado" id="" cols="30" rows="10">{{old('significado', $zone->significado)}}</textarea>
            @error ('significado')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Descripcion</legend>
            <textarea name="descripcion" id="" cols="30" rows="10">{{old('descripcion', $zone->descripcion)}}</textarea>
            @error ('descripcion')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Acceso</legend>
            <textarea name="acceso" id="" cols="30" rows="10">{{old('acceso', $zone->acceso)}}</textarea>
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
            <input type="time" id="hora" name="de_hora" value="{{$de_hora}}">
            @error ('de_hora')
                <div class="error">{{$message}}</div>
            @enderror

            <label for="a_hora">a las:</label>
            <input type="time" id="hora" name="a_hora" value="{{$a_hora}}">
            @error ('a_hora')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Costo de la entrada</legend>
            <span><strong><em>$</em> </strong></span><input type="text" name="costo" maxlength="4" value="{{old('costo', $zone->costoEntrada)}}">
            @error ('costo')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <textarea name="contacto" id="" cols="30" rows="10">{{old('contacto', $zone->contacto)}}</textarea>
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
            <legend>Fotos</small></legend>
            @foreach ($zone->fotos as $img)
                <label for="up_img">Actualizar imagen</label>
                <input type="hidden" name="current_imgs_dec[{{hash_img($img->idZonaFoto)}}]" value="{{$img->idZonaFoto}}">
                <input type="file" name="current_imgs_{{hash_img($img->idZonaFoto)}}" accept="image/*">

                <input type="checkbox" name="to_eliminate_imgs[{{hash_img($img->idZonaFoto)}}]" value="{{$img->idZonaFoto}}" id="" onchange="crrnt_imgs_disables('{{hash_img($img->idZonaFoto)}}')"> Eliminar imagen

                <div> <img src="{{img_u_url($img->foto)}}" width="300px" alt="zona-arqueologica"> </div>
            @endforeach

            @error ('current_imgs_*') <div class="error">{{$message}}</div> @enderror
            @error ('to_eliminate_imgs') <div class="error">{{$message}}</div> @enderror
            @error ('new_imgs') <div class="error">{{$message}}</div> @enderror
        </fieldset>

        @if ($img_zone_count < 4)
            <fieldset>
                <legend>Añadir fotos <small>(minimo 2, maximo 4)</legend>
                <input type="file" name="new_imgs[]" multiple accept="image/*">
            </fieldset>
        @endif

        <button type="submit">Guardar</button>
    </form>

@endsection

@section('js')
    <script>
        function crrnt_imgs_disables(img) {
            var fileInput = document.querySelector(`input[name="current_imgs_${img}"]`);
            var checkbox = document.querySelector(`input[name="to_eliminate_imgs[${img}]"]`);

            checkbox.checked ? fileInput.disabled = true : fileInput.disabled = false;
        }
    </script>
@endsection
