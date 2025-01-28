<?php
// Verifica si el carrito está vacío
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<h1>El carrito está vacío</h1>";
}

// Obtiene el contenido del carrito
$carrito = $_SESSION['carrito'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Carga el CSS de Bootstrap para estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Carga el JavaScript de Bootstrap para funcionalidades -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
</head>
<body>
    <?php include(__DIR__ . "/../encabezado.php"); ?> <!-- Incluye el encabezado común en todas las páginas -->

    <div class="container mt-5">
        <h2>Carrito de Compras</h2>
        <?php if (isset($_SESSION['compra_exitosa'])) { ?>
            <div class="alert alert-success" role="alert">
                ¡Compra realizada con éxito!
            </div>
            <?php unset($_SESSION['compra_exitosa']); // Elimina el mensaje de éxito de la sesión ?>
        <?php } ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Cantidad</th>
                    <th>Precio Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalCompra = 0;
                foreach ($carrito as $index => $item) {
                    $evento = new Evento($item['idEvento']);
                    $evento->consultar();
                    $precioTotal = $evento->getPrecio() * $item['cantidad'];
                    $totalCompra += $precioTotal;
                    echo "<tr>";
                    echo "<td>" . $evento->getNombre() . "</td>";
                    echo "<td>" . $item['cantidad'] . "</td>";
                    echo "<td>$" . number_format($precioTotal, 2) . "</td>";
                    echo "<td><a href='?pid=" . base64_encode("presentacion/compra/eliminarDelCarrito.php") . "&index=$index' class='btn btn-danger'>Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <h3>Total de la Compra: $<?php echo number_format($totalCompra, 2); ?></h3>
        <a href="?pid=<?php echo base64_encode("presentacion/compra/comprarCarrito.php")?>" class="btn btn-primary">Proceder a la Compra</a>
    </div>
</body>
</html>