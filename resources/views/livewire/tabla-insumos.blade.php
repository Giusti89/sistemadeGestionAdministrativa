<div>

    <link rel="stylesheet" href="../css/cotizacion.css">
    <section>
        <div>
            <section class="seccion1">
                <label class="titulo" for="titulo">
                    <h1 style="color: yellow">Cotización sobre el trabajo de:</h1>
                </label>
                <br>
                <h1>{{ $trabajo }}</h1>
            </section>

        </div>
        <div class="principal">
            <section class="seccion1">
                <div class="tabla tabla1">
                    <div class="table-container">
                        <h1>Insumos</h1>
                        <table>
                            <thead>
                                <tr>
                                    <th>Insumos</th>
                                    <th>Detalle</th>
                                    <th>Costo</th>
                                    <th>Modificación</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insumos as $trab)
                                    <tr>
                                        <td class="filas-tabla">
                                            {{ $trab->nombre }}
                                        </td>
                                        <td class="filas-tabla">
                                            {{ $trab->detalle }}
                                        </td>
                                        <td class="filas-tabla">
                                            {{ $trab->costo }}
                                        </td>
                                        <td class="filas-tabla">
                                            <x-layouts.btnmodif class="modificar" rutaEnvio="editInsumo"
                                                dato="{{ $trab->id }}" nombre="Modificar">
                                                </x-layouts.btnenviodat>
                                        </td>
                                        <td class="filas-tabla">
                                            <div>
                                                <form class="eli" action="{{ route('eliInsumo', $trab->id) }}"
                                                    method="POST">
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
                            <tfoot>
                                <tr>
                                    <th>Costo</th>
                                    <td class="filas-tabla" colspan="1"></td>
                                    <td class="filas-tabla" colspan="1"> {{ $total }}</td>
                                    <td class="filas-tabla"></td>
                                    <td class="filas-tabla"></td>
                                </tr>
                            </tfoot>
                        </table>
                        {{ $insumos->links() }}
                    </div>
                </div>
            </section>
            <div class="enviodatos">
                <div class="formulario">
                    <section>

                        <form method="POST" action="{{ route('createInsumo') }}">
                            @csrf
                            <h1>Insumos/Servicios</h1>

                            <div class="frm">


                                <input type="hidden" name="trabajo_id" value="{{ $identificador }}">

                                <div class="datos">
                                    <label for="insumo">Nombre insumo/servicio: </label>
                                    <input type="text" required id="insumo" name="insumo" autofocus value="{{old("insumo",)}}">
                                    @error('insumo')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="datos">
                                    <label for="costo">Costo: </label>
                                    <input type="decimal" required id="costo" name="costo" value="{{old("costo",)}}">
                                    @error('costo')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="datos">
                                    <label for="detalle">Detalles: </label>
                                    <textarea cols="15" rows="5" required id="detalle" name="detalle">{{old("detalle")}}</textarea>
                                    @error('detalle')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button class="registrar">
                                <p>Registrar</p>
                            </button>

                            <div class="forget">
                                <a href="{{ route('trabIndex') }}">Regresar</a>
                            </div>
                        </form>

                    </section>
                </div>
            </div>
            <div class="terminar">

                <form class="confirm" method="POST" action="{{ route('terminarInsumo') }}">
                    @csrf
                    <input hidden id="id" name="id" type="text" value="{{ $trabajoid }}">
                    <input hidden id="total" name="total" type="text" value="{{ $total }}">
                    <button class="registrar">
                        <p>Terminarr</p>
                    </button>

                </form>
            </div>


        </div>




    </section>
    @section('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $('.eli').submit(function(e) {
                e.preventDefault()

                Swal.fire({
                    title: "¿Estas seguro de eliminar este insumo?",
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

            $('.confirm').submit(function(e) {
                e.preventDefault()

                Swal.fire({
                    title: "¿Tu cotizacion ya fue aceptada por el cliente?",
                    text: "¡No podrás modificar los datos de la cotización!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, confirmar"
                }).then((result) => {
                    if (result.value) {
                        this.submit();
                    }
                });
            });
        </script>
    @endsection
</div>
