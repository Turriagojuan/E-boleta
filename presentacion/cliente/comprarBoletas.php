<?php
// Verifica si el usuario ha iniciado sesión; si no, redirige a la página de inicio de sesión

$id = $_SESSION["id"];
$rol = $_SESSION["rol"];

if($rol != "C"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
}

// Obtiene el ID del cliente y los datos del formulario de compra
$cliente = new Cliente($id);
$idEvento = $_POST['idEvento'];
$cantidad = $_POST['cantidad'];
$nombresUsuarios = $_POST['nombresUsuarios'];

// Consulta el evento para obtener el precio
$evento = new Evento($idEvento);
$evento->consultar();
$precioTotal = $evento->getPrecio() * $cantidad; // Calcula el precio total de la compra

// Crea una nueva factura para la compra
$factura = new Factura();
$idFactura = $factura->crearFactura($id, $idEvento, $precioTotal);

// Crea las boletas según la cantidad de usuarios especificada
for ($i = 0; $i < $cantidad; $i++) {
    $nombreUsuario = $nombresUsuarios[$i]; // Obtiene el nombre del usuario para cada boleta
    $boleta = new Boleta(0, $nombreUsuario, $idEvento, $id); // Crea una nueva instancia de Boleta
    $boleta->crearBoleta($idFactura); // Guarda la boleta en la base de datos asociándola a la factura
}

// Redirige a la página de confirmación de compra con el ID de la factura generada
header("Location: ?pid=" . base64_encode("presentacion/compra/confirmacionCompra.php") . "&idFactura=" .  $idFactura  . "&id=" . base64_encode($id) . "&rol=" . base64_encode($rol) );
exit();
?>
