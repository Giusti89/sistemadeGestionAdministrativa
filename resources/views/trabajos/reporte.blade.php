<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/reporte.css">
    <title>Document</title>
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
                <p>{{$trabajo->trabajo}}</p>
                <table>
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                        
                            <th>Detalle</th>
                            <th>Total</th>

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
                            <th>Costo</th>
                            <td class="filas-tabla" colspan="1"></td>
                           
                            <td class="filas-tabla" colspan="1"> {{ $total }} Bs.</td>
                           
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>

    </div>
</body>

</html>
