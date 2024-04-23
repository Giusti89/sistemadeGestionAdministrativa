<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$titulo ?? ''}}</title>
    <link rel="icon" href="">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="{{ $css ?? '' }}">
</head>
<body>
    @if (session('error'))
        <div class="alert alert-danger">
            <div class="mensajes">
                {{ session('error') }}
            </div>
        </div>
    @endif
    {{ $slot }}
</body>
</html>