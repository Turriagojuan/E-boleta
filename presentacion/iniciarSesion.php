<?php
$error = false;
if (isset($_POST["autenticar"])) {
    $proveedor = new Proveedor(null, null, $_POST["correo"], null, null, md5($_POST["clave"]));
    if ($proveedor->autenticar()) {
        $_SESSION["id"] = $proveedor -> getIdPersona();
        $_SESSION["rol"] = "P";
        header("Location: ?pid=" . base64_encode("presentacion/sesionProveedor.php"));
    } else {
        $cliente = new Cliente(null, null, $_POST["correo"], null, null, md5($_POST["clave"]));
        if($cliente -> autenticar()){
            $_SESSION["id"] = $cliente -> getIdPersona();
            $_SESSION["rol"] = "C";
            header("Location: ?pid=" . base64_encode("presentacion/sesionCliente.php"));
        }else{
            $error = true;
        }
    }
}
include ("presentacion/encabezado.php")?>
<div class="container">
	<div class="row mt-5">
		<div class="col-4"></div>
		<div class="col-4">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Iniciar Sesion</h4>
				</div>
				<div class="card-body">
					<form method="post"
						action="?pid=<?php echo base64_encode("presentacion/iniciarSesion.php")?>">
						<div class="mb-3">
							<input type="email" name="correo" class="form-control"
								placeholder="Correo" required>
						</div>
						<div class="mb-3">
							<input type="password" name="clave" class="form-control"
								placeholder="Clave" required>
						</div>
						<button type="submit" name="autenticar" class="btn btn-primary">Iniciar
							Sesion</button>
						<h5>
							<a
								href="?pid=<?php echo base64_encode("presentacion/cliente/registrarCliente.php")?>">Registrar
								Cliente</a>
						</h5>
						<?php if($error){ ?>
                        <div class="alert alert-danger mt-3"
								role="alert">Error de correo o clave</div>    
						<?php } ?>
					
					
					</form>
				</div>
			</div>
		</div>
	</div>
</div>