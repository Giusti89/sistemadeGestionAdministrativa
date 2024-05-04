<div>
    <link rel="stylesheet" href="./css/dashbord.css">

    <div class="botones">
        <div>
            <x-layouts.btnconfirmar contenido="Crear Cliente" enlace="clientes.nuevo">
            </x-layouts.btnconfirmar>
        </div>
        <div>
            <label for="">Buscar por nombre:</label>
            <input type="text" wire:model.live="search">
        </div>
        <div>
            <label for="paginate">Mostrar numero de registros</label>
            <input type="number" wire:model.live="paginate">
        </div>

        @if ($diferenciaDias <= 5)
            <div id="anuncio" class="anuncio">
                <h1>Le quedan {{ $diferenciaDias }} dias de suscripcion</h1>                
            </div>
        @endif



    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Contacto</th>
                    <th>Nit</th>
                    <th>Email</th>
                    <th>Modificación</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cli)
                    <tr>
                        <td class="filas-tabla">
                            {{ $cli->nombre }}
                        </td>
                        <td class="filas-tabla">
                            {{ $cli->apellido }}
                        </td>
                        <td class="filas-tabla">
                            {{ $cli->contacto }}
                        </td>
                        <td class="filas-tabla">
                            {{ $cli->nit }}
                        </td>
                        <td class="filas-tabla">
                            {{ $cli->email }}
                        </td>
                        <td class="filas-tabla">
                            <div>
                                <x-layouts.btnmodif rutaEnvio="editCliente" dato="{{ $cli->id }}"
                                    nombre="Modificar">
                                    </x-layouts.btnenviodat>
                            </div>
                        </td>
                        <td class="filas-tabla">
                            <div>
                                <div>
                                    <form class="eli" action="{{ route('elicliente', $cli->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-layouts.btnelim contenido="Eliminar">
                                        </x-layouts.btnelim>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $clientes->links() }}
    </div>
    @section('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $('.eli').submit(function(e) {
                e.preventDefault()

                Swal.fire({
                    title: "¿Estas seguro de eliminar este cliente?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminar"
                }).then((result) => {
                    if (result.value) {
                        this.submit();
                    }
                });
            });
        </script>
    @endsection
</div>
