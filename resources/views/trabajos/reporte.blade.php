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
                {{-- <div class="logo">
                    <img src="../img/logoayacucho.jpg">
                </div> --}}
            </div>
            <div class="cuerpo">
                <h1>Cotización</h1>
                <p>descripcion del trabajo a realizar
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Nombre</th>
                            <th>Detalle</th>
                            <th>Total</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td class="filas-tabla">
                                    {{ $item->cantidad }}
                                </td>
                                <td class="filas-tabla">
                                    {{ $item->nombre }}
                                </td>
                                <td class="filas-tabla">
                                    {{ $item->detalle }}
                                </td>
                                <td class="filas-tabla">

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Costo</th>
                            <td class="filas-tabla" colspan="1"></td>
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
