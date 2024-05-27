<x-layouts.nuevos titulo="Realizar pagos" css="../css/pagos.css">
    <section>
        <section>
            <h1>Monto adeudado</h1>
            <h2> <b>TOTAL:{{ $trab->Costofinal }} / SALDO:{{ $ordenpago->saldo }}</b></h2>
        </section>
        <section>
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
                    @foreach ($pago as $item)
                        <tr>
                            <td class="filas-tabla">
                                {{ $item->id }}
                            </td>
                            <td class="filas-tabla">
                                {{ $item->pago }}
                            </td>
                            <td class="filas-tabla">
                                {{ $item->fecha }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <section>
            <form method="POST" action="{{ route('pagoStore') }}">
                @csrf
                <h1>Insumos/Servicios</h1>

                <div class="frm">

                    <input hidden name="trabajo_id" value="{{ $ordenpago->id }}">

                    <div class="datos">
                        <label for="pago">Importe: </label>
                        <input type="decimal" required id="pago" name="pago">
                    </div>

                    <div class="datos">
                        <label for="fecha">Fecha: </label>
                        <input type="date" required id="fecha" name="fecha">
                    </div>

                </div>
                @if ($ordenpago->saldo == 0)
                    <div class="forget">
                        <a href="{{ route('pagoIndex') }}">Regresar</a>
                    </div>
                @else
                    <button class="registrar">
                        <p>Registrar</p>
                    </button>
                @endif

            </form>
        </section>
        @if ($ordenpago->saldo != 0)
            <div class="forget">
                <a href="{{ route('pagoIndex') }}">Regresar</a>
            </div>
        @endif


    </section>

</x-layouts.nuevos>
