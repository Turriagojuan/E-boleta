<?php
session_start();
require("logica/Factura.php");
require("logica/Boleta.php");
require("logica/Evento.php");
require("logica/Cliente.php");

if (!isset($_SESSION['idCliente'])) {
    header("Location: iniciarSesion.php");
    exit();
}

$idFactura = $_GET['idFactura'];

// Consultar la información de la factura
$factura = new Factura($idFactura);
$factura->consultar();

// Consultar la información de cliente
$cliente = new Cliente($_SESSION['idCliente']);
$cliente->consultar();


// Consultar el evento asociado a la factura
$evento = new Evento($factura->getIdEvento());
$evento->consultar();

// Consultar las boletas asociadas a la factura
$boleta = new Boleta();
$boletas = $boleta->consultarPorFactura($idFactura);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra</title>
</head>

<body>
    <?php include("encabezado.php"); ?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2>Confirmación de Compra</h2>
                <p><strong>Número de factura:</strong> <?php echo $factura->getIdFactura(); ?></p>
                <p><strong>Cliente:</strong> <?php echo $cliente->getNombre(); ?></p>
                <p><strong>Fecha:</strong> <?php echo $factura->getFecha(); ?></p>
                <p><strong>IVA Pagado:</strong> $<?php echo number_format($factura->getIva(), 2); ?></p>
                <p><strong>Subtotal Pagado:</strong> $<?php echo number_format($factura->getSubtotal(), 2); ?></p>
                <p><strong>Total Pagado:</strong> $<?php echo number_format($factura->getTotal(), 2); ?></p>
                <h3>Información del evento</h3>
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
                        $i = 1;
                        foreach ($boletas as $boletaActual) {
                            echo "<tr>";
                            echo "<td>" . $i++ . "</td>";
                            echo "<td>" . $boletaActual->getNombreUsuario() . "</td>";
                            echo "<td>" . $boletaActual->getIdBoleta() . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <a href="index.php" class="btn btn-primary">Volver al Inicio</a>
            </div>
        </div>
    </div>
</body>

</html>
