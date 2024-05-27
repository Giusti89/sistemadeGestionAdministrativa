<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Mensual</title>
    <style>
        /* Estilos para el PDF */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Balance Mensual</h1>
    @foreach($monthlyBalances as $balance)
        <h2>Mes: {{ $balance->month }}</h2>
        <p>Ingresos: {{ $balance->total_income }}</p>
        <p>Egresos: {{ $balance->total_expense }}</p>
        <p>Balance: {{ $balance->balance }}</p>
    @endforeach
</body>
</html>