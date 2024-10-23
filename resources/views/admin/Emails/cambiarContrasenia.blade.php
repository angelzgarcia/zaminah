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
                <button type="button" id="viewPass">ver</button>
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
                <button type="button" id="viewNewPass">ver</button>
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

    viewPass.addEventListener('click', function() {
        let tipo = pass.getAttribute('type') == 'text' ? 'password' : 'text';
        pass.setAttribute('type', tipo);

        this.textContent = tipo === 'password' ? 'ver' : 'ocultar';
    });

    viewNewPass.addEventListener('click', function() {
        let tipo = new_pass.getAttribute('type') == 'text' ? 'password' : 'text';
        new_pass.setAttribute('type', tipo);

        this.textContent = tipo === 'password' ? 'ver' : 'ocultar';
    });

</script>
