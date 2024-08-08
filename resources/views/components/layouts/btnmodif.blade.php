<link rel="stylesheet" href="../../css/btnmod.css">
<a  href="{{ route($rutaEnvio , $dato ) }}" >
    <button type="button" class="btn-modificar" {{$estado ?? ''}} style="background-color: {{$color ?? ''}}">
        {{$nombre}}
    </button>
</a>