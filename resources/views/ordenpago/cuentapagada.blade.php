<x-layouts.nuevos titulo="Realizar pagos" css="../css/viewpagos.css">
    <section>
        <section>
            <h1>Fechas del pago realizado</h1>
            {{-- <h2> <b> TOTAL:{{ $trab->Costofinal }}</b> / <b style="color: red">  SALDO:{{ $ordenpago->saldo }}</b></h2> --}}
        </section>
        <section>
            <h1>Pagos realizados</h1>
            <table>
                <thead>
                    <tr>
                        <th>Fecha de pago</th>
                        <th>Pago</th>
                        <th>PDF</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pago as $item)
                        <tr>
                            <td class="filas-tabla">
                                {{ $item->pago }}
                            </td>
                            <td class="filas-tabla">
                                {{ \Carbon\Carbon::parse($item->fecha)->format('d/m/Y') }}
                            </td>
                            <td class="filas-tabla">
                                @php
                                    $encryptedId = Crypt::encrypt($item->id);
                                @endphp
                            
                                <x-layouts.btnenviodat rutaEnvio="sueltoPdf" dato="{{ $encryptedId }}" nombre="Pdf"
                                    estado="_blank">
                                </x-layouts.btnenviodat>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <div class="flex items-center justify-end mt-4">
            <div class="forget">
                <a href="{{ route('pagoPagados') }}">Regresar</a>
            </div>
        </div>
    </section>

</x-layouts.nuevos>
