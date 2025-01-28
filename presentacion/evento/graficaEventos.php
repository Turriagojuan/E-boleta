<?php
$rol = $_SESSION["rol"];
if($rol != "P"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
}
$evento = new Evento();
$eventosPorCategoria = $evento -> consultarEventosPorCategoria();
include ("presentacion/encabezado.php");
include ("presentacion/menuProveedor.php");
?>
<div class="container">
	<div class="row mt-5">
		<div class="col">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Grafica Evento por Categoria</h4>
				</div>
				<div class="card-body">
					<div id='pieEventoPorCategoria'></div>
					<hr>
					<div id='columnEventoPorCategoria'></div>
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
      ['Categoria', 'Cantidad'],
    <?php 
    foreach ($eventosPorCategoria as $p){
        echo "['" . $p[0] . "', " . $p[1] . "],";
    }
    ?>
    ]);
    var options = {
      title: 'Eventos por Categoria'
    };
    var chartPie = new google.visualization.PieChart(document.getElementById('pieEventoPorCategoria'));
    chartPie.draw(data, options);
    var chartColumn = new google.visualization.ColumnChart(document.getElementById('columnEventoPorCategoria'));
    chartColumn.draw(data, options);
  }
</script>