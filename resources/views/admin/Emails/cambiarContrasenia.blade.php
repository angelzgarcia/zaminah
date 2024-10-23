<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cambiar Contraseña | INAH</title>
</head>
<body>
    @php $saludo = $user->genero == 'Masculino' ? $saludo = 'o' : 'a' @endphp
    <div class="update-password">
        <h1>Bienvenid{{"$saludo $user->nombre"}}</h1>
        <h2>Por seguridad, actualice su contraseña</h2>
        <form action="{{route('admin.verify_account.update')}}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <legend>Ingrese su contraseña temporal</legend>
                <input type="password" name="password" id="password" value="{{old('password')}}">
                @error('password')
                    <div class="error">{{$message}}</div>
                @enderror
                <button type="button" id="viewPass">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" fill="#111" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                </button>
            </fieldset>

            <fieldset>
                <legend>Ingrese su nueva contraseña</legend>
                <label for="pattern">
                    <small>
                        Minimo 8 carácteres, de los cuales al menos 1 mayuscula, 1 minúscuala,
                        un número y un carácter especial: <strong>¿ ? ! ¡ - . _ *</strong>
                    </small>
                </label>
                <br>
                <input type="password" name="new_password" id="new_password" value="{{old('new_password')}}">
                <button type="button" id="viewNewPass">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" fill="#111" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                </button>
            </fieldset>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>

<script>
    let viewPass = document.getElementById('viewPass');
    let pass = document.getElementById('password');
    let viewNewPass = document.getElementById('viewNewPass');
    let new_pass = document.getElementById('new_password');

    viewPass.addEventListener('mousedown', function() {
        pass.setAttribute('type', 'text');
    });
    viewPass.addEventListener('mouseup', function() {
        pass.setAttribute('type', 'password');
    });
    viewPass.addEventListener('mouseleave', function() {
        pass.setAttribute('type', 'password');
    });


    viewNewPass.addEventListener('mousedown', function() {
        new_pass.setAttribute('type', 'text');
    });
    viewNewPass.addEventListener('mouseup', function() {
        new_pass.setAttribute('type', 'password');
    });
    viewNewPass.addEventListener('mouseleave', function() {
        new_pass.setAttribute('type', 'password');
    });

</script>
