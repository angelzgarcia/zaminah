<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verificar Cuenta de Administrador | INAH</title>
</head>
<body>
    <div class="form-verify-account">
        <form action="{{route('admin.verify_account.verify')}}" method="POST" autocomplete="off">
            @csrf
            @method('put')
            <fieldset>
                <legend>Ingrese su Token de confirmación</legend>
                <input type="text" name="token" maxlength="10" minlength="8" value="{{old('token')}}">
                @error('token')
                    <div class="error">{{$message}}</div>
                @enderror
            </fieldset>
            <button type="submit">Validar</button>
        </form>
    </div>
</body>
</html>
