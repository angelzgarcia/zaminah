@extends('layouts.main')

@section('titulo', 'Contactanos | Ollin Code')

@section('users-content')
    <h1>Dejanos un mensaje y nos pondremos en contacto</h1>

    <div class="contact-us-form-container">
        <br>
        <form action="{{route('user.contactanos.store')}}" method="POST" autocomplete="off">

            @csrf

            <fieldset>
                <legend>Nombre</legend>
                <input type="text" name="nombre">
            </fieldset>
            <fieldset>
                <legend>Correo</legend>
                <input type="text" name="correo">
            </fieldset>
            <fieldset>
                <legend>Mensaje</legend>
                <textarea name="mensaje" rows="5" placeholder="Máximo 300 carácteres">{{ old('mensaje') }}</textarea>
            </fieldset>

            <button type="submit">Enviar</button>
        </form>

        @if(session('info'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "center",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "{!! session('info') !!}"
                });
            </script>
        @endif
    </div>
@endsection
