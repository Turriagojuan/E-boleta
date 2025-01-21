<?php
$rol = $_SESSION["rol"];
if($rol != "P"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));    
}
include ("presentacion/encabezado.php");
include ("presentacion/menuProveedor.php");
?>
<div class="container">
	<div class="row mb-3">
		<div class="col">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Buscar Evento</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-4"></div>
						<div class="col-4">
							<input type="text" id="filtro" class="form-control"
								placeholder="Buscar">
						</div>
					</div>
					<div class="row mt-3">
						<div class="col">
							<div id="resultado"></div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
  $("#filtro").keyup(function(){
  	if($("#filtro").val().length >= 3){
       url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/evento/buscarEventoAjax.php") . "&filtro=" ?>" + $("#filtro").val();
       $("#resultado").load(url);
    }
  });
});
</script>

