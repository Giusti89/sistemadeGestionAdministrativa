<div class="contenedor">
    <link rel="stylesheet" href="./css/dashbord.css">
    <div class="botones">

        <div>
            <label for="paginate">Filtrar por cliente:</label>
            <input type="text" wire:model.live="search">
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
                    <th>Descripción</th>
                    <th>Total</th>
                    <th>Saldo</th>
                    <th>Pagos</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $ordenpago)
                    <tr>

                        <td class="filas-tabla">
                            {{ $ordenpago->trabajo->cliente->nombre }}
                        </td>
                        <td class="filas-tabla">
                            {{ $ordenpago->trabajo->trabajo }}
                        </td>
                        <td class="filas-tabla">
                            {{ $ordenpago->trabajo->descripcion }}
                        </td>

                        <td class="filas-tabla">
                            {{ $ordenpago->total }}
                        </td>
                        <td class="filas-tabla">
                            {{ $ordenpago->saldo }}
                        </td>
                        <td>
                            @php
                                $encryptedId = Crypt::encrypt($ordenpago->id);
                            @endphp

                            @if ($ordenpago->saldo == 0)
                                <div>

                                    <x-layouts.btnenviodat rutaEnvio="pagoCreate" dato="{{ $encryptedId}}"
                                        idtrab="{{ $ordenpago->trabajo->id }}" nombre="Pagos realizados">
                                    </x-layouts.btnenviodat>
                                </div>
                            @else
                                <div>
                                    <x-layouts.btnenviodat rutaEnvio="pagoCreate" dato="{{ $encryptedId}}"
                                        idtrab="{{ $ordenpago->trabajo->id }}" nombre="Realizar pago">
                                    </x-layouts.btnenviodat>
                                </div>
                            @endif

                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}

    </div>
</div>
