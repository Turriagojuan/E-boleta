<?php
// Verifica si el usuario ha iniciado sesión; si no, redirige a la página de inicio de sesión
if (!isset($_SESSION['idCliente'])) {
    header("Location: ?pid=" . base64_encode("presentacion/iniciarSesion.php"));
    exit();
}

// Obtiene el ID de la factura a partir de la URL
$idFactura = $_GET['idFactura'];

// Consultar la información de la factura
$factura = new Factura($idFactura);
$factura->consultar(); // Llama al método para cargar los datos de la factura

// Consultar la información del cliente utilizando el ID almacenado en la sesión
$cliente = new Cliente($_SESSION['idCliente']);
$cliente->consultar(); // Llama al método para cargar los datos del cliente

// Consultar el evento asociado a la factura
$evento = new Evento($factura->getIdEvento());
$evento->consultar(); // Llama al método para cargar los datos del evento

// Consultar las boletas asociadas a la factura
$boleta = new Boleta();
$boletas = $boleta->consultarPorFactura($idFactura); // Obtiene las boletas relacionadas con la factura

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Incluye Bootstrap para el estilo de la página -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra</title>
</head>

<body>
    <?php include("presentacion/encabezado.php"); ?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2>Confirmación de Compra</h2>
                <!-- Muestra los detalles de la factura -->
                <p><strong>Número de factura:</strong> <?php echo $factura->getIdFactura(); ?></p>
                <p><strong>Cliente:</strong> <?php echo $cliente->getNombre(); ?></p>
                <p><strong>Fecha:</strong> <?php echo $factura->getFecha(); ?></p>
                <p><strong>IVA Pagado:</strong> $<?php echo number_format($factura->getIva(), 2); ?></p>
                <p><strong>Subtotal Pagado:</strong> $<?php echo number_format($factura->getSubtotal(), 2); ?></p>
                <p><strong>Total Pagado:</strong> $<?php echo number_format($factura->getTotal(), 2); ?></p>
                
                <h3>Información del evento</h3>
                <!-- Muestra los detalles del evento relacionado -->
                <p><strong>Evento:</strong> <?php echo $evento->getNombre(); ?></p>
                <p><strong>Ciudad:</strong> <?php echo $evento->getCiudad(); ?></p>
                <p><strong>Fecha:</strong> <?php echo $evento->getFecha(); ?> a las <?php echo $evento->getHora(); ?></p>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col">
                <h4>Boletas Compradas</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre del Usuario</th>
                            <th>ID del Boleto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1; // Contador para el número de boleta
                        // Recorre las boletas y muestra sus detalles en la tabla
                        foreach ($boletas as $boletaActual) {
                            echo "<tr>";
                            echo "<td>" . $i++ . "</td>"; // Muestra el número de boleta
                            echo "<td>" . $boletaActual->getNombreUsuario() . "</td>"; // Muestra el nombre del usuario
                            echo "<td>" . $boletaActual->getIdBoleta() . "</td>"; // Muestra el ID de la boleta
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <!-- Botón para volver al inicio -->
                <a href="?" class="btn btn-primary">Volver al Inicio</a>
            </div>
        </div>
    </div>
</body>

</html>
