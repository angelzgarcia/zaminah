
@extends('layouts.main-admin')

@section('titulo', 'Editar | INAH | Admin')

@section('admin-content')
    <h2><a href="{{route('admin.cultures.index')}}">Volver a las culturas</a></h2>
    <h2><a href="{{route('admin.cultures.show', $culture->idCultura)}}">Volver</a></h2>

    <h1>VAS A EDITAR LA CULTURA <em><big>"{{$culture->idCultura}}"</big></em></h1>

    <form action="{{route('admin.cultures.update', $culture)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        {{-- NOMBRE --}}
        <fieldset>
            <legend>Nombre</legend>
            <input type="text" name="nombre" value="{{old('nombre', $culture->nombre)}}" >
            @if ($errors -> has('nombre'))
                <div class="error">{{ $errors -> first('nombre') }}</div>
            @endif
        </fieldset>
        {{-- PERIODO --}}
        <fieldset>
            <legend>Periodo</legend>
            <textarea name="periodo" id="" cols="30" rows="10" >{{old('periodo', $culture->periodo)}}</textarea>
            @if ($errors -> has('periodo'))
                <div class="error">{{$errors -> first('periodo')}}</div>
            @endif
        </fieldset>
        {{-- SIGNIFICADO --}}
        <fieldset>
            <legend>Significado</legend>
            <textarea name="significado" id="" cols="30" rows="10" >{{old('significado', $culture->significado)}}</textarea>
            @if ($errors -> has('significado'))
                <div class="error">{{$errors -> first('significado')}}</div>
            @endif
        </fieldset>
        {{-- DESCRIPCION --}}
        <fieldset>
            <legend>Descripcion</legend>
            <textarea name="descripcion" id="" cols="30" rows="10" >{{old('descripcion', $culture->descripcion)}}</textarea>
            @error ('descripcion')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>
        {{-- APORTACIONES --}}
        <fieldset>
            <legend>Aportaciones</legend>
            <textarea name="aportaciones" id="" cols="30" rows="10" >{{old('aportaciones', $culture->aportaciones)}}</textarea>
            @if ($errors -> has('aportaciones'))
                <div class="error">{{$errors -> first('aportaciones')}}</div>
            @endif
        </fieldset>
        {{-- FOTOS --}}
        <fieldset>
            <legend>Fotos {{$img_cnt}}</legend>
            @error ('to_eliminate_imgs')
                <div class="error">{{$message}}</div>
            @enderror
            @error ('new_imgs')
                <div class="error">{{$message}}</div>
            @enderror
            @error ('current_imgs_*')
                <div class="error">{{$message}}</div>
            @enderror
            @foreach ($culture->fotos as $foto)
                {{$foto->idCulturaFoto}}
                <label for="imgs_update">Actualizar imagen</label>
                <input type="hidden" name="current_imgs_dec[{{hash_img($foto->idCulturaFoto)}}]" value="{{$foto->idCulturaFoto}}">
                <input type="file" name="current_imgs_{{hash_img($foto->idCulturaFoto)}}" accept="image/*">

                <input type="checkbox" name="to_eliminate_imgs[{{hash_img($foto->idCulturaFoto)}}]" value="{{$foto->idCulturaFoto}}" onchange="crrnt_imgs_disables('{{hash_img($foto->idCulturaFoto)}}')">Eliminar imagen

                <div>
                    <img src="{{img_u_url($foto->foto)}}" width="300px" alt="cultura">
                </div>
            @endforeach
        </fieldset>
        {{-- AÑADIR IMAGENES --}}
        @if ($img_cnt < 4)
            <fieldset>
                <legend>Añadir imagenes</legend>
                <input type="file" name="new_imgs[]" accept="image/*" multiple>
            </fieldset>
        @endif

        <button type="submit">Guardar cambios</button>
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
