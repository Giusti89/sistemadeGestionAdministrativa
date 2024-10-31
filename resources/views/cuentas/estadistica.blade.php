@extends('layouts.estats')
@section('titulo', 'Estadísticas')
@section('nombre', 'Estadísticas')
@section('contenido')


    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $clientCount }}</h3>
                            <p>Clientes Totales</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-bar-chart-line" style="font-size: 3.0rem; color: black;"></i>
                        </div>
                        <a href="{{ route('clientIndex') }}" class="small-box-footer">Mas información <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $newClientsCount }}</h3>

                            <p>Clientes nuevos</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-person-circle" style="font-size: 3.0rem; color: black;"></i>
                        </div>
                        <a href="{{ route('nuevoCliente') }}" class="small-box-footer">Agregar cliente <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $porpagar }}</h3>

                            <p>Cuentas por cobrar</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-credit-card-2-back" style="font-size: 3.0rem; color: black;"></i>
                        </div>
                        <a href="{{ route('pagoIndex') }}" class="small-box-footer">ir a la pagina <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $pagados }}</h3>

                            <p>Cuentas pagadas</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-coin" style="font-size: 3.0rem; color: black;"></i>
                        </div>
                        <a href="{{ route('pagoPagados') }}" class="small-box-footer">Mas información <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <div>
        <h1>Trabajos cobrados.</h1>
        <canvas id="myChart"></canvas>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('myChart').getContext('2d');
            const ordenesPorMes = @json(array_values($ordenesPorMes));
            const trabajosPorMes = @json(array_values($trabajosPorMes));
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    datasets: [{
                        label: 'Trabajos cobrados',
                        data: ordenesPorMes,
                        borderWidth: 1,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                    },
                    {
                        label: 'Trabajos por mes',
                        data: trabajosPorMes,
                        borderWidth: 1,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                    }]                   
                },
              
                
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    @endsection

   



