<x-layouts.nuevos titulo="Realizar pagos" css="../css/pagos.css">
    <section>
        <section>
            <h1>Monto total adeudado</h1>
            <h2> <b>{{ $trabajo->Costofinal }}</b></h2>
        </section>
        <section >
            <h1>Pagos realizados</h1>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Pago</th>
                        <th>Fecha de pago</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="filas-tabla">
                            <p></p>
                        </td>
                        <td class="filas-tabla">
                            <p></p>
                        </td>
                        <td class="filas-tabla">
                            <p></p>
                        </td>
                    </tr>


                </tbody>
            </table>
        </section>
        <section>
            <form method="POST" action="{{ route('pagoStore') }}">
                @csrf
                <h1>Insumos/Servicios</h1>

                <div class="frm">

                    <input  name="trabajo_id" value="{{ $trabajo->id }}">

                    <div class="datos">
                        <label for="costo">Costo: </label>
                        <input type="decimal" required id="costo" name="costo">
                    </div>

                    
                </div>

                <button class="registrar">
                    <p>Registrar</p>
                </button>

               
            </form>
        </section>
        <div class="forget">
            <a href="{{ route('pagoIndex') }}">Regresar</a>
        </div>

    </section>

</x-layouts.nuevos>
