<?php
session_start();
require("logica/Persona.php");
require("logica/Proveedor.php");
require("logica/Cliente.php");
$error = false;

if (isset($_POST["autenticar"])) {
    // Autenticación de Proveedores
    $proveedor = new Proveedor(null, null, $_POST["correo"], null, null, md5($_POST["clave"]));
    if ($proveedor->autenticar()) {
        $_SESSION["idProveedor"] = $proveedor->getIdPersona(); // Iniciar sesión para proveedor
		header("Location: sesionProveedor.php");
		exit();     
    } else {
        // Si no es proveedor, intentamos autenticar como cliente
		$cliente = new Cliente(null, null, $_POST["correo"], null, null, md5($_POST["clave"]));
        if ($cliente->autenticar()) {
            $_SESSION["idCliente"] = $cliente->getIdPersona(); // Iniciar sesión para cliente
            header("Location: index.php"); // Redirigir a la sesión del cliente
			exit();
		} else {
            $error = true; // Si no es cliente ni proveedor, mostrar error
        }
    }
}
?>

<html>
<head>
<link
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
	rel="stylesheet">
<script
	src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php include("encabezado.php") ?>
<div class="container">
		<div class="row mt-5">
			<div class="col-4"></div>
			<div class="col-4">
				<div class="card border-primary">
					<div class="card-header text-bg-info">
						<h4>Iniciar Sesion</h4>
					</div>
					<div class="card-body">
						<form method="post" action="iniciarSesion.php" >
							<div class="mb-3">
								<input type="email" name="correo" class="form-control" placeholder="Correo" required>
							</div>
							<div class="mb-3">
								<input type="password" name="clave" class="form-control" placeholder="Clave" required>
							</div>
							<button type="submit" name="autenticar" class="btn btn-primary">Iniciar Sesion</button>
							<?php if ($error) { ?>
                            <div class="alert alert-danger mt-3" role="alert">
                            	Error de correo o clave
							</div>    
							<?php } ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>