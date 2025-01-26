<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="img/logo.png" width="50" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <?php 
                    // Consultar y listar todas las categorías de eventos
                    $categoria = new Categoria();
                    $categorias = $categoria->consultarTodos();
                    foreach ($categorias as $categoriaActual) {
                        // Mostrar cada categoría como un enlace en el menú
                        echo "<li class='nav-item'><a class='nav-link' href='#' role='button'>" . $categoriaActual->getNombre() . "</a></li>";
                    }
                ?>
            </ul>
            <ul class="navbar-nav">
                <?php 
                if (isset($_SESSION['idCliente'])) {
                    // Mostrar el nombre del cliente autenticado
                    $cliente = new Cliente($_SESSION['idCliente']);
                    $cliente->consultar(); // Consultar el nombre del cliente desde la base de datos
                    echo "<li class='nav-item'><a class='nav-link' href='#'>Bienvenido, " . $cliente->getNombre() . "</a></li>";
                    echo "<li class='nav-item'><a href='?cerrarSesion=true' class='nav-link'>Cerrar Sesión</a></li>";
                } else {
                    // Mostrar opción para iniciar sesión si no está autenticado
                    echo "<li class='nav-item'><a href='?pid=" . base64_encode("presentacion/iniciarSesion.php") . "' class='nav-link'>Iniciar Sesión</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>