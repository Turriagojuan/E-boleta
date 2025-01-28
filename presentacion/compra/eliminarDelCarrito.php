<?php
session_start();

// Obtiene el índice del elemento a eliminar
$index = $_GET['index'];

// Elimina el elemento del carrito
unset($_SESSION['carrito'][$index]);

// Reindexa el carrito
$_SESSION['carrito'] = array_values($_SESSION['carrito']);

// Redirige a la página del carrito
header("Location: ?pid=" . base64_encode("presentacion/compra/verCarrito.php"));
exit();
?>