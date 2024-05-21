<div>
    <link rel="stylesheet" href="./css/dashbord.css">
    <div class="botones">
        <div>
            <x-layouts.btnconfirmar contenido="Registrar gasto" enlace="gastos.nuevo">
            </x-layouts.btnconfirmar>
        </div>

        <div>
            <label for="month">Mes:</label>
            <input type="number" id="month" wire:model="mes" min="1" max="12">
        </div>
        <div>
            <label for="year">Año:</label>
            <input type="number" id="year" wire:model="anio" min="2000" max="2100">
        </div>


        <div>
            <label for="paginate">Numero de registros de la tabla</label>
            <input type="number" wire:model.live="paginate">
        </div>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th>Descripcion</th>
                    <th>Costo</th>
                    <th>Fecha</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($gastos as $gasto)
                    <tr>
                        <td>{{ $gasto->concepto }}</td>
                        <td>{{ $gasto->descripcion }}</td>
                        <td>{{ $gasto->costo }}</td>
                        <td>{{ $gasto->fecha }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $gastos->links() }}
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
