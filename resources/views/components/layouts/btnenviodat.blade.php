<link rel="stylesheet" href="../../css/btnenviodat.css">

<a href="{{ route($rutaEnvio, $dato) }}" target="{{$estado ?? ''}}">
    <button type="button" class="modificar" {{$estado ?? ''}} >
        {{$nombre}}
    </button>
</a>