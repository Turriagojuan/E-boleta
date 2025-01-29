<?php
// Verifica si el usuario ha iniciado sesión; si no, redirige a la página de inicio de sesión

$rol = $_SESSION["rol"];

if($rol != "C"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
}

// Obtiene los datos del formulario
$idEvento = $_POST['idEvento'];
$cantidad = $_POST['cantidad'];
$nombresUsuarios = $_POST['nombresUsuarios'];
$accion = $_POST['accion'];

if ($accion == 'comprar') {
    // Procesar la compra directa

    // Obtiene el ID del cliente
    $idCliente = $_SESSION['id'];

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
    header("Location: ?pid=" . base64_encode("presentacion/compra/confirmacionCompra.php") . "&idFactura=" .  $idFactura  . "&id=" . base64_encode($id) . "&rol=" . base64_encode($rol) );
    exit();
} elseif ($accion == 'agregarCarrito') {
    // Agregar al carrito

    // Verifica si el carrito ya existe en la sesión
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Agrega las boletas al carrito
    $_SESSION['carrito'][] = [
        'idEvento' => $idEvento,
        'cantidad' => $cantidad,
        'nombresUsuarios' => $nombresUsuarios
    ];

    // Redirige a la página del carrito
    header("Location: ?pid=" . base64_encode("presentacion/compra/verCarrito.php"));
    exit();
}
?>
