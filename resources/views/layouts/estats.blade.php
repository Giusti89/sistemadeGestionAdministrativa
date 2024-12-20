<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title> @yield('titulo') </title>

    {{-- adminLTE --}}
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    {{-- adminLTE --}}
    
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

    @if (session('msj') == 'fallo')
        <script>
            Swal.fire({
                title: "No se puede realizar la solicitud",
                text: "Su archivo no ha sido eliminado.",
                icon: "warning"
            });
        </script>
    @endif

    @if (session('msj') == 'cambio')
        <script>
            Swal.fire({
                title: "Correcto",
                text: "Su solicitud a sido ejecutada.",
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

    @if (session('msj') == 'error')
        <script>
            Swal.fire({
                title: "OPERACION NO PERMITIDA",
                text: "Su solicitud no puede ser ejecutada.",
                icon: "warning"
            });
        </script>
    @endif

    <!-- mensajes de confirmacion -->
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @yield('nombre')
            </h2>
            @if (\Carbon\Carbon::now()->diffInDays(Auth::user()->final) <= 5)
                <div class="contadorDias">
                    <p style="color: red; margin-top:8px;">
                        Le quedan {{ \Carbon\Carbon::now()->diffInDays(Auth::user()->final) }} dia de suscripcion
                        contactese con el proveedor del servicio
                    </p>
                </div>
            @endif

        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @yield('contenido')
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</html>
