<?php
require("logica/Boleta.php");
require("logica/Evento.php");
require("logica/Factura.php");
session_start();

if (!isset($_SESSION['idCliente'])) {
    header("Location: iniciarSesion.php"); // Redirigir al login si no está autenticado
    exit();
}

$idCliente = $_SESSION['idCliente'];
$idEvento = $_POST['idEvento'];
$cantidad = $_POST['cantidad'];
$nombresUsuarios = $_POST['nombresUsuarios'];

// Consultar el evento para obtener el precio
$evento = new Evento($idEvento);
$evento->consultar();
$precioTotal = $evento->getPrecio() * $cantidad; // Calcular el precio total

// Crear una factura
$factura = new Factura();
$factura->crearFactura($idCliente, $idEvento, $precioTotal);

// Crear boletas
for ($i = 0; $i < $cantidad; $i++) {
    $nombreUsuario = $nombresUsuarios[$i];
    $boleta = new Boleta(0, $nombreUsuario, $idEvento, $idCliente);
    $boleta->crearBoleta();
}

// Redirigir a la página de confirmación
header("Location: confirmacionCompra.php");
exit();
?>
