<?php
$rol = $_SESSION["rol"];
if($rol != "P"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
}
$error = 0;
if(isset($_POST["editar"])){    
    $nombre = $_FILES["imagen"]["name"];
    $extension = pathinfo($nombre, PATHINFO_EXTENSION);
    $extensiones = array('jpg','png','jpeg');
    if(in_array($extension, $extensiones)){
        $tam = $_FILES["imagen"]["size"] / 1024;
        if($tam < 150){
            $rutaLocal = $_FILES["imagen"]["tmp_name"];
            $rutaServidor = "imagenes/";
            $nombreImagen = time() . "." . $extension;
            $evento = new Evento($_GET["idEvento"]);
            $evento -> consultar();
            if($evento -> getImagen() != ""){
                unlink($rutaServidor . $evento -> getImagen());
            }
            copy($rutaLocal, $rutaServidor . $nombreImagen);
            $evento = new Evento($_GET["idEvento"], "", 0, 0, 0, $nombreImagen);
            $evento -> editarImagen();
            
        }else{
            $error = 2;
        }
    }else{
        $error = 1;
    }    
    
}
$evento = new Evento($_GET["idEvento"]);
$evento -> consultar();
include ("presentacion/encabezado.php");
include ("presentacion/menuAdministrador.php");
?>
<div class="container">
	<div class="row mt-5">
		<div class="col-4"></div>
		<div class="col-4">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Editar Imagen del Evento <br><?php echo $evento -> getNombre()?></h4>
				</div>
				<div class="card-body">
    				<?php 
    				if (isset($_POST["editar"])) { 
    				    if($error == 0){
    				        echo "<div class='alert alert-success mt-3' role='alert'>Imagen editada</div>";
    				    }else if($error == 1){
    				        echo "<div class='alert alert-danger mt-3' role='alert'>Tipo de imagen no permitido</div>";
    				    }else if($error == 2){
    				        echo "<div class='alert alert-danger mt-3' role='alert'>Tamaño de imagen no permitido</div>";
    				    }
    				}    				    
    				?>
					<form method="post"
						action="?pid=<?php echo base64_encode("presentacion/evento/editarEventoImagen.php")?>&idEvento=<?php echo $_GET["idEvento"] ?>"
						enctype="multipart/form-data">
						<div class="mb-3">
							<input type="file" name="imagen" class="form-control"
								placeholder="Nombre" value="<?php echo $evento -> getNombre() ?>" required>
						</div>
						<button type="submit" name="editar" class="btn btn-primary">Editar Evento</button>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>