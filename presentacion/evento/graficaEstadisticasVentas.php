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
                    <div id='pieVentasPorEvento'></div>
                    <hr>
                    <div id='columnVentasPorEvento'></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Evento', 'Cantidad de Ventas'],
    <?php 
    foreach ($ventasPorEvento as $venta){
        echo "['" . $venta[0] . "', " . $venta[1] . "],";
    }
    ?>
    ]);
    var options = {
      title: 'Ventas de Boletas por Evento'
    };
    var chartPie = new google.visualization.PieChart(document.getElementById('pieVentasPorEvento'));
    chartPie.draw(data, options);
    var chartColumn = new google.visualization.ColumnChart(document.getElementById('columnVentasPorEvento'));
    chartColumn.draw(data, options);
  }
</script>