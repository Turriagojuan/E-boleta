<?php
require ("logica/Evento.php");
require ("logica/Sector.php");

// Obtener el idEvento de la URL
$idEvento = $_GET['idEvento'];

// Consultar el evento seleccionado
$evento = new Evento($idEvento);
$evento->consultar();

// Consultar los sectores disponibles para el evento
$sector = new Sector();
$sectores = $sector->consultarPorEvento($idEvento);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Evento</title>
</head>

<body>
    <?php include("encabezado.php"); ?>

    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col">
                <div class="card border-primary">
                    <div class="card-header text-bg-info">
                        <h4><?php echo $evento->getNombre(); ?></h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Descripción:</strong> <?php echo $evento->getDescripcion(); ?></p>
                        <p><strong>Ciudad:</strong> <?php echo $evento->getCiudad(); ?></p>
                        <p><strong>Fecha:</strong> <?php echo $evento->getFecha(); ?> a las <?php echo $evento->getHora(); ?></p>
                        <h5>Selecciona un sector y compra tus boletas</h5>
                        
                        <form action="comprarBoletas.php" method="POST">
                            <input type="hidden" name="idEvento" value="<?php echo $idEvento; ?>" />
                            <div class="mb-3">
                                <label for="sector" class="form-label">Sector</label>
                                <select name="idSector" id="sector" class="form-select" required>
                                    <?php foreach ($sectores as $sectorActual) { ?>
                                        <option value="<?php echo $sectorActual->getIdSector(); ?>">
                                            <?php echo $sectorActual->getNombre(); ?> - $<?php echo $sectorActual->getPrecio(); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad de boletas</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Comprar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
