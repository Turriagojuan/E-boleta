<?php

// Obtiene el ID del cliente
$idCliente = $_SESSION['id'];

$rol = $_SESSION["rol"];
if($rol != "C"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
}
// Verifica si el carrito está vacío
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<h1>El carrito está vacío</h1>";
    exit();
}

// Obtiene el contenido del carrito
$carrito = $_SESSION['carrito'];

// Procesa cada evento en el carrito
$facturas = [];
foreach ($carrito as $item) {
    $idEvento = $item['idEvento'];
    $cantidad = $item['cantidad'];
    $nombresUsuarios = $item['nombresUsuarios'];

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

    // Almacena el ID de la factura para abrir la confirmación más tarde
    $facturas[] = $idFactura;
}

// Limpia el carrito después de la compra
unset($_SESSION['carrito']);

// Establece un mensaje de éxito en la sesión
$_SESSION['compra_exitosa'] = true;

// Redirige a la página del carrito
//header("Location: ?pid=" . base64_encode("presentacion/compra/verCarrito.php"));
//exit();

echo "<script>
    // Mostrar mensaje de éxito
    alert('Compra realizada con éxito. Puede revisar su factura en el menú principal.');
    
    // Redirigir al usuario a la página de sesión cliente
    window.location.href = '?pid=" . base64_encode("presentacion/sesionCliente.php") . "';
</script>";
?>