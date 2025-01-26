<?php
$error = false; // Inicializar la variable de error
$exito = false; // Inicializar la variable de éxito

// Verificar si se envió el formulario de registro

if (isset($_POST["registrar"])) {
    // Crear objeto Cliente con los datos del formulario
    $cliente = new Cliente(null, $_POST["nombre"], $_POST["correo"], $_POST["telefono"], $_POST["direccion"], md5($_POST["clave"]));
    if ($cliente->registrar()) { // Intentar registrar al cliente
        $exito = true; // Marcar éxito en el registro
    } else {
        $error = true; // Marcar error en el registro
    }
}
?>

<html>
<head>
    <!-- Enlazar Bootstrap CSS y JS para el diseño -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include("presentacion/encabezado.php"); ?> <!-- Incluir el encabezado de la página -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card border-primary w-50">
            <div class="card-header text-bg-info">
                <h4>Registrar Cliente</h4> <!-- Título del formulario -->
            </div>
            <div class="card-body">
                <?php if ($exito) { ?>
                    <div class="alert alert-success" role="alert"> <!-- Mensaje de éxito si el registro es exitoso -->
                        Registro exitoso. <a href="?pid=<?php echo base64_encode("presentacion/iniciarSesion.php")?>">Iniciar sesión</a>
                    </div>
                <?php } ?>
                <?php if ($error) { ?>
                    <div class="alert alert-danger" role="alert"> <!-- Mensaje de error si el registro falla -->
                        Error en el registro. Inténtalo de nuevo.
                    </div>
                <?php } ?>
                <form method="post" action="?pid=<?php echo base64_encode("presentacion/cliente/registrarCliente.php")?>"> <!-- Formulario para registrar cliente -->
                    <div class="mb-3">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required> <!-- Campo para el nombre -->
                    </div>
                    <div class="mb-3">
                        <input type="email" name="correo" class="form-control" placeholder="Correo" required> <!-- Campo para el correo -->
                    </div>
                    <div class="mb-3">
                        <input type="text" name="telefono" class="form-control" placeholder="Teléfono" required> <!-- Campo para el teléfono -->
                    </div>
                    <div class="mb-3">
                        <input type="text" name="direccion" class="form-control" placeholder="Dirección" required> <!-- Campo para la dirección -->
                    </div>
                    <div class="mb-3">
                        <input type="password" name="clave" class="form-control" placeholder="Clave" required> <!-- Campo para la contraseña -->
                    </div>
                    <button type="submit" name="registrar" class="btn btn-primary w-100">Registrar</button> <!-- Botón para enviar el formulario -->
                </form>
            </div>
        </div>
    </div>
</body>
</html>