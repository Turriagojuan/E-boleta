<?php

// Verifica si el usuario ha iniciado sesión; si no, redirige a la página de inicio de sesión
$rol = $_SESSION["rol"];
if($rol != "C"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
}
$idCliente = $_SESSION["id"];
$cliente = new Cliente($idCliente);
$cliente->consultar();

// Consultar todas las facturas del cliente
$facturas = $cliente->consultarFactura($idCliente);
?>
 <?php include("presentacion/encabezado.php"); ?>
<div class="container mt-5">
    <h2>Mis Compras</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Número de Factura</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Total</th>
                <th>Evento</th>
                <th>Cliente</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facturas as $factura) { 
                $evento = new Evento($factura[6]); // Acceder al índice numérico
                $evento->consultar();
                $cliente->consultar(); // Consultar datos del cliente
            ?>
                <tr>
                    <td><?php echo $factura[0]; ?></td>
                    <td><?php echo $factura[4]; ?></td>
                    <td><?php echo $factura[5]; ?></td>
                    <td>$<?php echo number_format($factura[1], 2); ?></td>
                    <td><?php echo $evento->getNombre(); ?></td>
                    <td><?php echo $cliente->getNombre(); ?></td>
                    <td><?php echo $cliente->getDireccion(); ?></td>
                    <td><?php echo $cliente->getTelefono(); ?></td>
                    <td>
                        <a href="?pid=<?php echo base64_encode("presentacion/cliente/generarFactura.php"); ?>&idFactura=<?php echo $factura[0]; ?>" class="btn btn-primary">Generar PDF</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
