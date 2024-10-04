<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/reporte.css">
    <title>Cotización</title>
</head>

<body>
    <div class="contenedor">
        <div class="lienzo">
            <div class="encabezado">
                {{-- <div class="direccion">
                    <p>
                    </p>
                </div> --}}
                <div class="logo">
                    <img src="{{ public_path('storage/' . $user->logo) }}" alt="Logo">
                </div>
            </div>
            <div class="cuerpo">
                <h1>Cotización</h1>
                <p>Señor(es):{{$trabajo->cliente->nombre}}
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Concepto</th>
                            <th>Totall</th>

                        </tr>
                    </thead>

                    <tbody>
                        
                            <tr>
                                <td class="filas-tabla">
                                    {{ $trabajo->cantidad }}
                                </td>
                                <td class="filas-tabla">
                                    {{ $trabajo->descripcion }}
                                </td>
                               <td class="filas-tabla">

                               </td>
                               
                            </tr>
                       
                    </tbody>
                    <tfoot>
                        <tr>
                          
                            <td class="filas-tabla" colspan="1"></td>
                            <td class="filas-tabla" colspan="1"></td>
                            <th class="filas-tabla" colspan="1"> {{ $total }} Bs.</th>
                           
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>

    </div>
</body>

</html>
