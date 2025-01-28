<?php
session_start();

// Cerrar sesión si se recibe el parámetro "cerrarSesion"
if (isset($_GET["cerrarSesion"])) {
    session_destroy(); // Destruir la sesión actual
    header("Location: ?"); // Redirigir al index después de cerrar sesión
    exit(); // Terminar el script
}

require_once("logica/Persona.php");
require_once("logica/Proveedor.php");
require_once("logica/Cliente.php");
require_once("logica/Evento.php");
require_once("logica/Categoria.php");
require_once("logica/Boleta.php");
require_once("logica/Factura.php");


$paginasSinSesion = array(
    "presentacion/iniciarSesion.php",
    "presentacion/sinPermiso.php",
    "presentacion/evento/detalleEvento.php",
    "presentacion/cliente/registrarCliente.php",
);

$paginasConSesion = array(
    "presentacion/proveedor/sesionProveedor.php",
    "presentacion/evento/agregarEvento.php",
    "presentacion/evento/agregar.php",
    "presentacion/compra/comprarBoletas.php",
    "presentacion/compra/verCarrito.php",
    "presentacion/compra/comprarCarrito.php",
    "presentacion/compra/eliminarDelCarrito.php",
    "presentacion/compra/confirmacionCompra.php",
);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Enlazar Bootstrap CSS y JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eboleta</title>
</head>

<body>
<?php
if (!isset($_GET["pid"])) {
    include("presentacion/encabezado.php"); // Incluir el encabezado de la página
    include("presentacion/menu.php");
    include("presentacion/evento/listaEventos.php");
} 
else {
    $pid = base64_decode($_GET["pid"]);
    if (in_array($pid, $paginasSinSesion)) {
        include($pid);
    } else if (in_array($pid, $paginasConSesion)) {
        if (isset($_SESSION["idProveedor"]) or isset($_SESSION["idCliente"])) {
            include($pid);
        } else {
            include("presentacion/iniciarSesion.php");
        }
    } else {
        echo "<h1>Error 404</h1>";        
    }
}
?>
    
</body>

</html>
