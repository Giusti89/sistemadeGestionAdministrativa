<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title> @yield('titulo') </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <!-- mensajes de confirmacion -->
    @if (session('msj') == 'ok')
        <script>
            Swal.fire({
                title: "Eliminado",
                text: "Su archivo ha sido eliminado.",
                icon: "success"
            });
        </script>
    @endif

    @if (session('msj') == 'cambio')
        <script>
            Swal.fire({
                title: "Correcto",
                text: "Su insumo fue agregado correctamente.",
                icon: "success"
            });
        </script>
    @endif

    @if (session('msj') == 'prohibido')
        <script>
            Swal.fire({
                title: "NO TIENES LOS PERMISOS",
                text: "Su solicitud no puede ser ejecutada.",
                icon: "warning"
            });
        </script>
    @endif

    @if (session('chk') == 'realizado')
    <script>
        Swal.fire({
            title: "REALIZADO",
            text: "Su insumo fue modificado correctamente.",
            icon: "success"
        });
    </script>
@endif

    <!-- mensajes de confirmacion -->


    @yield('contenido')



    @livewireScripts
    @yield('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>
