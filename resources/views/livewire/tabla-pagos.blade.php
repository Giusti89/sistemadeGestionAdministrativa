<div>
    <link rel="stylesheet" href="./css/dashbord.css">
    <div class="botones">

        <div>
            <label for="paginate">Filtrar por cliente</label>
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
                    <th>Id</th>
                    <th>Cliente</th>
                    <th>Trabajo</th>
                    <th>Descripcion</th>
                    <th>Total</th>
                    <th>Saldo</th>
                    <th>Pagos</th>


                </tr>
            </thead>
            <tbody>

                @foreach ($data as $insumos)
                    <tr>
                        <td class="filas-tabla">
                            {{ $insumos->trabajo->id }}
                        </td>
                        <td class="filas-tabla">
                            {{ $insumos->trabajo->cliente->nombre }}
                        </td>
                        <td class="filas-tabla">
                            {{ $insumos->trabajo->trabajo }}
                        </td>
                        <td class="filas-tabla">
                            {{ $insumos->trabajo->descripcion }}
                        </td>

                        <td class="filas-tabla">
                            {{ $insumos->total }}
                        </td>
                        <td class="filas-tabla">
                            {{ $insumos->saldo }}
                        </td>
                        <td>
                            <div>
                                <x-layouts.btnenviodat rutaEnvio="pagoCreate" dato="{{ $insumos->id }}"
                                    nombre="Realizar pago">
                                </x-layouts.btnenviodat>
                            </div>
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}

    </div>
</div>
