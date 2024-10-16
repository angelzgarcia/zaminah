
@extends('layouts.main-admin')

@section('titulo', 'Editar | INAH | Admin')

@section('admin-content')
    <h2><a href="{{route('admin.cultures.index')}}">Volver a las culturas</a></h2>
    <h2><a href="{{route('admin.cultures.show', $culture->idCultura)}}">Volver</a></h2>

    <h1>VAS A EDITAR LA CULTURA <em><big>"{{$culture->idCultura}}"</big></em></h1>

    <form action="{{route('admin.cultures.update', $culture->idCultura)}}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('put')

        <fieldset>
            <legend>Nombre</legend>
            <input type="text" name="nombre" value="{{old('nombre', $culture->nombre)}}" >
            @if ($errors -> has('nombre'))
                <div class="error">{{ $errors -> first('nombre') }}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Periodo</legend>
            <textarea name="periodo" id="" cols="30" rows="10" >{{old('periodo', $culture->periodo)}}</textarea>
            @if ($errors -> has('periodo'))
                <div class="error">{{$errors -> first('periodo')}}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Significado</legend>
            <textarea name="significado" id="" cols="30" rows="10" >{{old('significado', $culture->significado)}}</textarea>
            @if ($errors -> has('significado'))
                <div class="error">{{$errors -> first('significado')}}</div>
            @endif
        </fieldset>

        <fieldset>
            <legend>Descripcion</legend>
            <textarea name="descripcion" id="" cols="30" rows="10" >{{old('descripcion', $culture->descripcion)}}</textarea>
            @error ('descripcion')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Fotos</legend>
            @foreach ($culture->fotos as $foto)
                {{-- <input type="hidden" name="imgs_actuales_ids[]" value="{{ $foto->idCulturaFoto }}"> --}}

                {{$foto->idCulturaFoto}}
                <label for="imgs_update">Actualizar imagen</label>
                <input type="file" name="imgs_actuales_ids[{{$foto->idCulturaFoto}}]" id="imgs_actuales" multiple>

                <input type="checkbox" name="imgs_delete[]" id="imgs_delete" value="{{$foto->idCulturaFoto}}">Eliminar imagen

                <div>
                    <img src="{{img_u_url($foto->foto)}}" width="300px" alt="cultura">
                </div>

                @if ($errors -> has('fotos'))
                    <div class="error">{{$errors -> first('fotos')}}</div>
                @endif
            @endforeach
        </fieldset>

        @if ($img_cnt != 4)
            <fieldset>
                <legend>Añadir imagenes</legend>
                <input type="file" name="imgs_nuevas[]" id="imgs_nuevas" accept="image/*" multiple>
            </fieldset>
        @endif

        <fieldset>
            <legend>Aportaciones</legend>
            <textarea name="aportaciones" id="" cols="30" rows="10" >{{old('aportaciones', $culture->aportaciones)}}</textarea>
            @if ($errors -> has('aportaciones'))
                <div class="error">{{$errors -> first('aportaciones')}}</div>
            @endif
        </fieldset>

        <button type="submit">Guardar cambios</button>
    </form>
@endsection


@section('js')

    <script>
        var ipfl = document.querySelectorAll('input[name="imgs_nuevas[]"]');
        var chbx = document.querySelectorAll('input[name="imgs_delete[]"]');

        chbx.forEach((checkbox, index) => {
            checkbox.addEventListener('change', function() {
                checkbox.checked ? ipfl[index].disabled = true : ipfl[index].disabled = false
            });
        });
    </script>

@endsection
