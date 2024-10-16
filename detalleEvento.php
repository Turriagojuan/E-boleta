<?php
require("logica/Evento.php");

// Obtener el idEvento de la URL
$idEvento = $_GET['idEvento'];

// Consultar el evento seleccionado
$evento = new Evento($idEvento);
$evento->consultar();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Evento</title>
    <script>
        // Función para generar campos de nombres según la cantidad de boletas seleccionadas
        function generarCamposNombres() {
            let cantidad = document.getElementById('cantidad').value;
            let contenedorNombres = document.getElementById('contenedorNombres');
            contenedorNombres.innerHTML = ""; // Limpiar campos previos

            for (let i = 1; i <= cantidad; i++) {
                let campo = `<div class="mb-3">
                                <label for="nombreUsuario${i}" class="form-label">Nombre del Usuario ${i}</label>
                                <input type="text" name="nombresUsuarios[]" id="nombreUsuario${i}" class="form-control" required>
                             </div>`;
                contenedorNombres.innerHTML += campo;
            }
        }
    </script>
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
                        <p><strong>Direccion:</strong> <?php echo $evento->getDireccion(); ?></p>
                        <p><strong>Fecha:</strong> <?php echo $evento->getFecha(); ?> a las <?php echo $evento->getHora(); ?></p>
                        <p><strong>Precio:</strong> $<?php echo number_format($evento->getPrecio(), 2); ?></p>
                        <h5>Selecciona una cantidad y compra tus boletas</h5>
                        
                        <form action="comprarBoletas.php" method="POST">
                            <input type="hidden" name="idEvento" value="<?php echo $idEvento; ?>" />
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad de boletas</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" required onchange="generarCamposNombres()">
                            </div>
                            <!-- Aquí se generarán los campos para los nombres de los usuarios -->
                            <div id="contenedorNombres"></div>
                            <button type="submit" class="btn btn-primary">Comprar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
