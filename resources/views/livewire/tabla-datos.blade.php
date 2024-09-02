<div>
    <link rel="stylesheet" href="./css/estadisticas.css">
    <div class="titulo">
        <h1>Estadísticas Generales</h1>
    </div>
    <div class="contenedor">
        <div class="lateral">
            <div class="bloque">
                <p><b>{{ $clientCount }}</b> </p>
                <p>Clientes totales</b> </p>
            </div>
            <div class="bloque">
                <p> <b>{{ $newClientsCount }}</b> </p>
                <p>Nuevos clientes</p>
            </div>
        </div>

        <div class="cuadroG">
            <p>{{$ganancias}}</p>
            <p>Ganancias totales</p>
        </div>
        <div class="cuadroP">
          <p>{{$perdidas+$totalGastos}}</p>
          <p>Total Gastos</p>
        </div>

        <div class="lateral">
            <div class="bloque">
                <p><b>{{ $jobCount}} </b> </p>
                <p>Total de Trabajos </p>
            </div>
            <div class="bloque">
                <p><b>{{ $newJobCount}} </b> </p>
                <p>Nuevos Trabajos</b> </p>
            </div>
        </div>
    </div>

    <div class="contenedor">
        <div class="lateral">
            <div class="bloque">
                <p><b>{{ $totalGastos }} Bs.</b> </p>
                <p>Gasto total </p>
            </div>
            <div class="bloque">
                <p><b>{{ $GastosMes}} Bs.</b></p>
                <p>Gastos mensuales</p>
            </div>
        </div>

        <div class="cuadro">
            <p>datos estadisticos 7</p>
        </div>
        <div class="cuadrom">
           <p>datos estadisticos 8</p>
        </div>
        <div class="cuadro">
            <p>datos estadisticos 9</p>
        </div>
        
    </div>

</div>
