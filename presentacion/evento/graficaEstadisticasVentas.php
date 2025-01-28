<?php
$rol = $_SESSION["rol"];
if($rol != "P"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
}
$boleta = new Boleta();
$ventasPorEvento = $boleta->obtenerVentasPorEvento();
include ("presentacion/encabezado.php");
include ("presentacion/menuProveedor.php");
?>
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="card border-primary">
                <div class="card-header text-bg-info">
                    <h4>Estadísticas de Ventas de Boletas</h4>
                </div>
                <div class="card-body">
                    <canvas id="ventasChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Reemplazar estos datos con los obtenidos del backend
        const eventos = <?php echo json_encode(array_column($ventasPorEvento, 'evento')); ?>;
        const totalBoletas = <?php echo json_encode(array_column($ventasPorEvento, 'total_boletas')); ?>;

        const ctx = document.getElementById('ventasChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: eventos,
                datasets: [{
                    label: 'Boletas Vendidas',
                    data: totalBoletas,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    });
</script>
