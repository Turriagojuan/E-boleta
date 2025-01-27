<?php
// Incluye la clase Evento para manejar la lógica relacionada con eventos
require("./logica/Evento.php");

// Obtiene el idEvento de la URL mediante el método GET
$idEvento = $_GET['idEvento'];

// Crea una nueva instancia de Evento y consulta la información del evento seleccionado
$evento = new Evento($idEvento);
$evento->consultar();
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
    <title>Detalle del Evento</title>
    <script>
        // Función para generar campos de nombres según la cantidad de boletas seleccionadas
        function generarCamposNombres() {
            let cantidad = document.getElementById('cantidad').value; // Obtiene la cantidad seleccionada
            let contenedorNombres = document.getElementById('contenedorNombres');
            contenedorNombres.innerHTML = ""; // Limpiar campos previos

            // Genera los campos de entrada para los nombres de los usuarios
            for (let i = 1; i <= cantidad; i++) {
                let campo = `<div class="mb-3">
                                <label for="nombreUsuario${i}" class="form-label">Nombre del Usuario ${i}</label>
                                <input type="text" name="nombresUsuarios[]" id="nombreUsuario${i}" class="form-control" required>
                             </div>`;
                contenedorNombres.innerHTML += campo; // Agrega el nuevo campo al contenedor
            }
        }
    </script>
</head>
<body>
    <?php include("encabezado.php"); ?> <!-- Incluye el encabezado común en todas las páginas -->

    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col">
                <div class="card border-primary">
                    <div class="card-header text-bg-info">
                        <h4><?php echo $evento->getNombre(); ?></h4> <!-- Muestra el nombre del evento -->
                    </div>
                    <div class="card-body">
                        <p><strong>Descripción:</strong> <?php echo $evento->getDescripcion(); ?></p> <!-- Muestra la descripción del evento -->
                        <p><strong>Ciudad:</strong> <?php echo $evento->getCiudad(); ?></p> <!-- Muestra la ciudad del evento -->
                        <p><strong>Dirección:</strong> <?php echo $evento->getDireccion(); ?></p> <!-- Muestra la dirección del evento -->
                        <p><strong>Fecha:</strong> <?php echo $evento->getFecha(); ?> a las <?php echo $evento->getHora(); ?></p> <!-- Muestra la fecha y hora del evento -->
                        <p><strong>Precio:</strong> $<?php echo number_format($evento->getPrecio(), 2); ?></p> <!-- Muestra el precio del evento con formato monetario -->
                        <h5>Selecciona una cantidad y compra tus boletas</h5>
                        
                        <!-- Formulario para comprar boletos -->
                        <form action="comprarBoletas.php" method="POST">
                            <input type="hidden" name="idEvento" value="<?php echo $idEvento; ?>" /> <!-- Campo oculto para el ID del evento -->
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad de boletas</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" required onchange="generarCamposNombres()"> <!-- Campo para ingresar la cantidad de boletos -->
                            </div>
                            <!-- Aquí se generarán los campos para los nombres de los usuarios -->
                            <div id="contenedorNombres"></div> <!-- Contenedor donde se agregarán dinámicamente los campos de nombres -->
                            <button type="submit" class="btn btn-primary">Comprar</button> <!-- Botón para enviar el formulario -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>