<?php
// Verifica si el proveedor ha iniciado sesión; si no, redirige a la página de inicio de sesión
$rol = $_SESSION["rol"];
if($rol != "P"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));    
}

$id = $_SESSION["idProveedor"];
$proveedor = new Proveedor($id);
$proveedor->consultar();
?>

<html>
<body>
    <!-- Incluye el encabezado común en todas las páginas -->
    <?php include("presentacion/encabezado.php"); ?>

    <div class="container mt-5">
        <h2>Agregar Nuevo Evento</h2>
        <!-- Formulario para agregar un nuevo evento -->
        <form action="?pid=<?php echo base64_encode("presentacion/evento/agregar.php")?>" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Evento</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="aforo" class="form-label">Aforo</label>
                <input type="number" class="form-control" id="aforo" name="aforo" required>
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" class="form-control" id="hora" name="hora" required>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <textarea class="form-control" id="imagen" name="imagen" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría:</label>
                <select id="categoria" name="idCategoria" class="form-select" required>
                    <?php
                    // Incluye la clase Categoria para manejar categorías de eventos
                    require_once('logica/Categoria.php');
                    $categoria = new Categoria();
                    
                    // Obtiene todas las categorías disponibles
                    $categorias = $categoria->consultarTodos();
                    foreach ($categorias as $categoriaActual) {
                        // Crea una opción en el select por cada categoría
                        echo "<option value='" . htmlspecialchars($categoriaActual->getIdCategoria()) . "'>" . htmlspecialchars($categoriaActual->getNombre()) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Botón para enviar el formulario -->
            <button type="submit" class="btn btn-primary">Agregar Evento</button>
        </form>
    </div>
</body>
</html>
