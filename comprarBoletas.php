<?php
// Importa las clases necesarias para manejar boletas, eventos y facturas
require("logica/Boleta.php");
require("logica/Evento.php");
require("logica/Factura.php");

// Inicia la sesión para acceder a los datos del cliente
session_start();

// Verifica si el usuario ha iniciado sesión; si no, redirige a la página de inicio de sesión
if (!isset($_SESSION['idCliente'])) {
    header("Location: iniciarSesion.php");
    exit();
}

// Obtiene el ID del cliente y los datos del formulario de compra
$idCliente = $_SESSION['idCliente'];
$idEvento = $_POST['idEvento'];
$cantidad = $_POST['cantidad'];
$nombresUsuarios = $_POST['nombresUsuarios'];

// Consulta el evento para obtener el precio
$evento = new Evento($idEvento);
$evento->consultar();
$precioTotal = $evento->getPrecio() * $cantidad; // Calcula el precio total de la compra

// Crea una nueva factura para la compra
$factura = new Factura();
$idFactura = $factura->crearFactura($idCliente, $idEvento, $precioTotal);

// Crea las boletas según la cantidad de usuarios especificada
for ($i = 0; $i < $cantidad; $i++) {
    $nombreUsuario = $nombresUsuarios[$i]; // Obtiene el nombre del usuario para cada boleta
    $boleta = new Boleta(0, $nombreUsuario, $idEvento, $idCliente); // Crea una nueva instancia de Boleta
    $boleta->crearBoleta($idFactura); // Guarda la boleta en la base de datos asociándola a la factura
}

// Redirige a la página de confirmación de compra con el ID de la factura generada
header("Location: confirmacionCompra.php?idFactura=" .  $idFactura);
exit();
?>
