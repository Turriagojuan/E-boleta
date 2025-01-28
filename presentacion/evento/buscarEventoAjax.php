<?php 
$filtro = isset($_GET["filtro"]) ? $_GET["filtro"] : ""; // Validación para evitar errores si el filtro no está definido
$evento = new Evento();
$eventos = $evento->buscar($filtro);
?>
<div class="container">
    <div class="row mb-3">
        <div class="col">		
            <?php 
            if (count($eventos) > 0) {
                echo "<table class='table table-striped table-hover'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Categoría</th>";
                echo "<th>Nombre</th>";
                echo "<th>Aforo</th>";
                echo "<th>Ciudad</th>";
                echo "<th>Dirección</th>";
                echo "<th>Fecha</th>";
                echo "<th>Hora</th>";
                echo "<th>Descripción</th>";
                echo "<th>Precio</th>";
                echo "<th>Imagen</th>";
                echo "<th>Acciones</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach ($eventos as $eventoActual) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($eventoActual->getCategoria()->getNombre()) . "</td>";
                    echo "<td>" . str_ireplace(
                        $filtro, 
                        "<strong>" . htmlspecialchars(substr($eventoActual->getNombre(), stripos($eventoActual->getNombre(), $filtro), strlen($filtro))) . "</strong>", 
                        htmlspecialchars($eventoActual->getNombre())
                    ) . "</td>";
                    echo "<td>" . $eventoActual->getAforo() . "</td>";
                    echo "<td>" . $eventoActual->getCiudad() . "</td>";
                    echo "<td>" . $eventoActual->getDireccion() . "</td>";
                    echo "<td>" . $eventoActual->getFecha() . "</td>";
                    echo "<td>" . $eventoActual->getHora() . "</td>";
                    echo "<td>" . $eventoActual->getDescripcion() . "</td>";
                    echo "<td>$" . $eventoActual->getPrecio() . "</td>";
                    echo "<td>" . 
                        (($eventoActual->getImagen() != "") 
                        ? "<img src='imagenes/" . htmlspecialchars($eventoActual->getImagen()) . "' height='50px' />" 
                        : "Sin Imagen") . 
                        "</td>";
                    echo "<td>
                            <a href='?pid=" . base64_encode("presentacion/evento/editarEvento.php") . "&idEvento=" . $eventoActual->getIdEvento() . "' title='Editar Evento'><i class='fas fa-edit'></i></a> 
                            <a href='?pid=" . base64_encode("presentacion/evento/editarEventoimagen.php") . "&idEvento=" . $eventoActual->getIdEvento() . "' title='Editar Imagen'><i class='fas fa-image'></i></a>
                          </td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<div class='alert alert-danger mt-3' role='alert'>No hay resultados que coincidan con el filtro.</div>";
            }
            ?>
        </div>
    </div>
</div>
