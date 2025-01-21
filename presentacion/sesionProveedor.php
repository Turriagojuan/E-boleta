<?php
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
if($rol != "P"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));    
}
include ("presentacion/encabezado.php");
include ("presentacion/menuProveedor.php");
$proveedor = new Proveedor($id);
$proveedor -> consultar();
?>
<div class="container">
	<div class="row mb-3">
		<div class="col">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Sesion Proveedor</h4>
				</div>
				<div class="card-body">
					<p>Bienvenido proveedor <?php echo $proveedor -> getNombre()?></p>
				</div>
			</div>
		</div>
	</div>
</div>