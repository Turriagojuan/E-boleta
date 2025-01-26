<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Iniciar la sesión para manejar las variables de sesión
}

// Incluir las clases necesarias para la autenticación de usuarios
require_once(__DIR__ . "/../logica/Persona.php");
require_once(__DIR__ . "/../logica/Proveedor.php");
require_once(__DIR__ . "/../logica/Cliente.php");

$error = false; // Inicializar la variable de error

// Verificar si se envió el formulario de autenticación
if (isset($_POST["autenticar"])) {
    // Autenticación de Proveedores
    $proveedor = new Proveedor(null, null, $_POST["correo"], null, null, md5($_POST["clave"])); // Crear objeto Proveedor
    if ($proveedor->autenticar()) { // Intentar autenticar al proveedor
        $_SESSION["idProveedor"] = $proveedor->getIdPersona(); // Iniciar sesión para proveedor
        header("Location: ?pid=" . base64_encode("presentacion/proveedor/sesionProveedor.php")); // Redirigir a la sesión del proveedor
        exit();     
    } else {
        // Si no es proveedor, intentamos autenticar como cliente
        $cliente = new Cliente(null, null, $_POST["correo"], null, null, md5($_POST["clave"])); // Crear objeto Cliente
        if ($cliente->autenticar()) { // Intentar autenticar al cliente
            $_SESSION["idCliente"] = $cliente->getIdPersona(); // Iniciar sesión para cliente
            header("Location: ?"); // Redirigir a la sesión del cliente
            exit();
        } else {
            $error = true; // Si no es cliente ni proveedor, marcar error
        }
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
    <?php include("encabezado.php") ?> <!-- Incluir el encabezado de la página -->
    <div class="container">
        <div class="row mt-5">
            <div class="col-4"></div> <!-- Espacio vacío para centrar el formulario -->
            <div class="col-4">
                <div class="card border-primary">
                    <div class="card-header text-bg-info">
                        <h4>Iniciar Sesion</h4> <!-- Título del formulario -->
                    </div>
                    <div class="card-body">
                        <form method="post" action="?pid=<?php echo base64_encode("presentacion/iniciarSesion.php")?>"> <!-- Formulario para iniciar sesión -->
                            <div class="mb-3">
                                <input type="email" name="correo" class="form-control" placeholder="Correo" required> <!-- Campo para el correo -->
                            </div>
                            <div class="mb-3">
                                <input type="password" name="clave" class="form-control" placeholder="Clave" required> <!-- Campo para la contraseña -->
                            </div>
                            <button type="submit" name="autenticar" class="btn btn-primary">Iniciar Sesion</button> <!-- Botón para enviar el formulario -->
                            <?php if ($error) { ?>
                                <div class="alert alert-danger mt-3" role="alert"> <!-- Mensaje de error si las credenciales son incorrectas -->
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
