<div class="container">
        <div class="row mb-3">
            <div class="col">
                <div class="card border-primary">
                    <div class="card-header text-bg-info">
                        <h4>Eventos</h4> <!-- Título de la sección de eventos -->
                    </div>
                    <div class="card-body">
    <?php
    $i = 0; // Contador para el diseño en columnas
    $evento = new Evento();
    $eventos = $evento->consultarTodos(); // Consultar todos los eventos

    foreach ($eventos as $eventoActual) {
        if ($i % 4 == 0) {
            echo "<div class='row mb-3'>"; // Iniciar una nueva fila cada 4 eventos
        }

        // Mostrar cada evento en una tarjeta
        echo "<div class='col-lg-3 col-md-4 col-sm-6'>";
        echo "<div class='card text-bg-light'>";
        
        // Imagen con tamaño fijo y proporcional
        echo "<div class='card-body d-flex flex-column justify-content-between' style='height: 350px;'>"; // Altura fija para uniformidad
        echo "<div class='text-center mb-3'>
                <img src='imagenes/" . $eventoActual->getImagen() . "' 
                     style='width: 70%; height: auto; max-width: 300px;' 
                     class='img-fluid mx-auto' />
              </div>";
        

        // Contenido textual del evento
        echo "<div class='text-start'>"; 
        echo "<a href='?pid=" . base64_encode("presentacion/evento/detalleEvento.php") . "&idEvento=" . $eventoActual->getIdEvento() . "'>
                " . $eventoActual->getNombre() . "
              </a><br>";
        echo "Ciudad: " . $eventoActual->getCiudad() . "<br>";
        echo "Fecha: " . $eventoActual->getFecha() . "<br>";
        echo "Aforo: " . $eventoActual->getAforo() . "<br>";
        echo "Categoría: " . $eventoActual->getCategoria()->getNombre() . "<br>";
        echo "</div>";
        echo "</div>"; // Cerrar card-body
        echo "</div>"; // Cerrar tarjeta
        echo "</div>"; // Cerrar columna

        if ($i % 4 == 3) {
            echo "</div>"; // Cerrar la fila después de 4 eventos
        }
        $i++; // Incrementar el contador
    }
    if ($i % 4 != 0) {
        echo "</div>"; // Cerrar la última fila si no está cerrada
    }
    ?>
</div>
                </div>
            </div>
        </div>
    </div>