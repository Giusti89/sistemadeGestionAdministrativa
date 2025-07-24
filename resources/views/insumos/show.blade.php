<x-layouts.nuevos titulo="Nuevos Clientes" css="../css/cotizacion.css">

    <div class="contenedor">
        <div class="tabla tabla1">
                    <h1>Insumos</h1>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Insumos</th>
                                    <th>Detalle</th>
                                    <th>Costo</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insumos as $trab)
                                    <tr>
                                        <td class="filas-tabla">
                                            {{ $trab->cantidad }}
                                        </td>
                                        <td class="filas-tabla">
                                            {{ $trab->nombre }}
                                        </td>
                                        <td class="filas-tabla">
                                            {{ $trab->detalle }}
                                        </td>
                                        <td class="filas-tabla">
                                            {{ $trab->costo }}
                                        </td>
                                        
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Costo</th>
                                    <td class="filas-tabla" colspan="1"></td>
                                    <td class="filas-tabla" colspan="1"></td>
                                    <td class="filas-tabla" colspan="1"> {{ $costoprod }} Bs.</td>
                                    
                                </tr>
                            </tfoot>
                        </table>
                        
                    </div>
                   
                </div>
    </div>



</x-layouts.nuevos>