<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Cuenta de Administrador</title>
    <style>
        .h1-mail {
            background-color: white;
        }
    </style>
</head>
<body>
    <h1 class="h1-mail">Bienvenido a la plataforma</h1>
    <p>Tu cuenta ha sido creada con éxito. A continuación, encontrarás tu contraseña temporal y tu token de verificación.</p>
    <p><strong>Contraseña Temporal:</strong> {{ $password }}</p>
    <p><strong>Token de Verificación:</strong> {{ $token }}</p>

    <p>Por favor, verifica tu cuenta utilizando el token.</p>

    <a href="http://localhost/zaminah/public/verify-admin-account">Verificar</a>
</body>
</html>
