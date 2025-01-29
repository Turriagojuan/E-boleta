<?php

// Verifica si el usuario ha iniciado sesión; si no, redirige a la página de inicio de sesión
$rol = $_SESSION["rol"];
if ($rol != "C") {
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
    exit();
}

$idCliente = $_SESSION["id"];
$cliente = new Cliente($idCliente);
$cliente->consultar();

// Consultar todas las boletas del cliente
$boleta = new Boleta();
$boletas = $boleta->consultarBoleta($idCliente);
?>
<?php include("presentacion/encabezado.php"); ?>
<div class="container mt-5">
    <h2>Mis Boletas</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Número de Boleta</th>
                <th>Nombre del Usuario</th>
                <th>Evento</th>
                <th>Cliente</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($boletas as $boleta) { 
                $evento = new Evento($boleta->getIdEvento());
                $evento->consultar();
                $cliente = new Cliente($boleta->getIdCliente());
                $cliente->consultar();
            ?>
                <tr>
                    <td><?php echo $boleta->getIdBoleta(); ?></td>
                    <td><?php echo $boleta->getNombreUsuario(); ?></td>
                    <td><?php echo $evento->getNombre(); ?></td>
                    <td><?php echo $cliente->getNombre(); ?></td>
                    <td><?php echo $cliente->getDireccion(); ?></td>
                    <td>
                        <a href="?pid=<?php echo base64_encode("presentacion/cliente/generarBoleta.php"); ?>&idBoleta=<?php echo $boleta->getIdBoleta(); ?>" class="btn btn-primary">Generar boleta</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
