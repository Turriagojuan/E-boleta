<?php
$rol = $_SESSION["rol"];
if($rol != "P"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
}
if(isset($_POST["editar"])){
    $evento = new Evento(
        $_GET["idEvento"], 
        $_POST["nombre"], 
        $_POST["aforo"], 
        $_POST["ciudad"], 
        $_POST["direccion"], 
        $_POST["fecha"], 
        $_POST["hora"], 
        $_POST["descripcion"], 
        $_POST["precio"]);
    $evento -> editar();
}else{
    $evento = new Evento($_GET["idEvento"]);
    $evento -> consultar();    
}

include("presentacion/encabezado.php");
include("presentacion/menuProveedor.php");

// Consultar datos del evento
$evento = new Evento($_GET["idEvento"]);
$evento->consultar();
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="card border-primary">
                <div class="card-header text-bg-info">
                    <h4>Editar Evento</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="?pid=<?php echo base64_encode("presentacion/evento/editarEvento.php") ?>&idEvento=<?php echo $_GET["idEvento"] ?>">
                        <!-- Campo para el nombre del evento -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del evento" value="<?php echo htmlspecialchars($evento->getNombre()) ?>" required>
                        </div>

                        <!-- Campo para el aforo -->
                        <div class="mb-3">
                            <label for="aforo" class="form-label">Aforo</label>
                            <input type="number" name="aforo" id="aforo" class="form-control" placeholder="Aforo máximo" value="<?php echo $evento->getAforo() ?>" min="1" required>
                        </div>

                        <!-- Campo para la ciudad -->
                        <div class="mb-3">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" name="ciudad" id="ciudad" class="form-control" placeholder="Ciudad" value="<?php echo htmlspecialchars($evento->getCiudad()) ?>" required>
                        </div>

                        <!-- Campo para la dirección -->
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección del evento" value="<?php echo htmlspecialchars($evento->getDireccion()) ?>" required>
                        </div>

                        <!-- Campo para la fecha -->
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $evento->getFecha() ?>" required>
                        </div>

                        <!-- Campo para la hora -->
                        <div class="mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" name="hora" id="hora" class="form-control" value="<?php echo $evento->getHora() ?>" required>
                        </div>

                        <!-- Campo para la descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Breve descripción del evento" required><?php echo htmlspecialchars($evento->getDescripcion()) ?></textarea>
                        </div>

                        <!-- Campo para el precio -->
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" name="precio" id="precio" class="form-control" placeholder="Precio del evento" value="<?php echo $evento->getPrecio() ?>" min="0" step="0.01" required>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" name="editar" class="btn btn-primary">Actualizar Evento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const formulario = document.querySelector("form");

        formulario.addEventListener("submit", function (event) {
            alert("El evento ha sido actualizado correctamente.");
        });
    });
</script>
