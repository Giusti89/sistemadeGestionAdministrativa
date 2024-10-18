<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/reporte.css">
    <title>Historial de pagos</title>
</head>

<body>
    <div class="contenedor">
        <div class="lienzo">
            <div class="encabezado">
                <div class="logo">
                    <img src="{{ public_path('storage/' . $user->logo) }}" alt="Logo">
                </div>
            </div>
            <div class="cuerpo">
                <h1>Historial de pagos</h1>

                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Monto</th>
                        </tr>
                    </thead>

                    <tbody>
                        <td class="filas-tabla">
                            {{ \Carbon\Carbon::parse($pago->fecha)->format('d/m/Y') }}
                        </td>
                        <td class="filas-tabla">
                            {{ $pago->pago }}
                        </td>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="filas-tabla" colspan="1">Total:</td>  
                            <th class="filas-tabla" colspan="1"> {{ $pago->pago }} Bs.</th>                          
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>