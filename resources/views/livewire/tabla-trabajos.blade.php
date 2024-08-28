<div>
    <link rel="stylesheet" href="./css/dashbord.css">

    <div class="botones">
        <div>
            <x-layouts.btnconfirmar contenido="Nuevo Trabajo" enlace="trabajos.nuevo">
            </x-layouts.btnconfirmar>
        </div>
        <div>
            <label for="paginate">Filtrar por cliente:</label>
            <input type="text" wire:model.live="search"> 
        </div>
        
        <div>
            <label for="filtro">Filtrar por mes: </label>
            <input type="month" wire:model="searchMonth">
        </div>

        <div>
            <label for="paginate">Mostrar numero de registros:</label>
            <input type="number" wire:model.live="paginate">

        </div>

    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Trabajo</th>
                    <th>Descripcion</th>
                    <th>Costo Produccion</th>
                    <th>Ganancia efectiva</th>
                    <th>Costo Final</th>
                    <th>Acción</th>
                    <th>Fecha de creación</th>
                    <th>Modificación</th>
                    <th>Eliminar</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($trab as $insumos)
                    <tr>

                        <td class="filas-tabla">
                            {{ $insumos->cliente->nombre }}
                        </td>
                        <td class="filas-tabla">
                            {{ $insumos->trabajo }}
                        </td>
                        <td class="filas-tabla">
                            {{ $insumos->descripcion }}
                        </td>

                        <td class="filas-tabla">
                            {{ $insumos->Costoproduccion }}
                        </td>

                        <td class="filas-tabla">
                            {{ $insumos->gananciaefectivo }}
                        </td>

                        <td class="filas-tabla">
                            {{ $insumos->Costofinal }}
                        </td>

                        <td class="filas-tabla">
                            {{ \Carbon\Carbon::parse($insumos->created_at)->format('d/m/Y') }}
                        </td>

                        <td>
                            <div>
                                @php
                                    $encryptedId = Crypt::encrypt($insumos->id);
                                @endphp
                                @if ($insumos->estado)
                                    <x-layouts.btnenviodat rutaEnvio="trabPdf" dato="{{ $insumos->id }} "
                                        nombre="Ver PDF" estado="_blank">
                                    </x-layouts.btnenviodat>
                                @else
                                    <x-layouts.btnenviodat rutaEnvio="insumoIndex" dato="{{ $encryptedId }}"
                                        nombre="Cotizar">
                                    </x-layouts.btnenviodat>
                                @endif

                            </div>
                        </td>

                        <td class="filas-tabla">
                            <div>
                                @if ($insumos->estado)
                                    <x-layouts.btnmodif rutaEnvio="editTrab" dato="{{ $insumos->id }}"
                                        nombre="Verificar" estado="disabled">
                                    </x-layouts.btnmodif>
                                @else
                                    <x-layouts.btnmodif rutaEnvio="editTrab" dato="{{ $insumos->id }}"
                                        nombre="Verificar">
                                    </x-layouts.btnmodif>
                                @endif
                            </div>
                        </td>
                        <td class="filas-tabla">
                            <div>
                                <form class="eli" action="{{ route('eliTrab', $insumos->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-layouts.btnelim contenido="Eliminar">
                                    </x-layouts.btnelim>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $trab->links() }}

    </div>
    @section('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $('.eli').submit(function(e) {
                e.preventDefault()

                Swal.fire({
                    title: "¿Estas seguro de eliminar este trabajo?",
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
