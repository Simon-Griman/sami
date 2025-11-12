<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SAMI | Cambio de Contraseña</title>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    <style>
        body{
            background-color: #ccc;
        }
        .principal{
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        h2{
            font-weight: bold;
        }
    </style>
    @livewireStyles
</head>
<body>
    <div class="principal">
        @livewire('nuevo-usuario')
    </div>
    @livewireScripts
</body>
</html>