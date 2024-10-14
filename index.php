<?php

require ("logica/Categoria.php");



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include("encabezado.php"); ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="img/logo.png" width="50" /></a>
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                        <?php 
                            $categoria = new Categoria();
                            $categorias = $categoria->consultarTodos();
                            foreach ($categorias as $categoriaActual) {
                                echo "<li class='nav-item '><a class='nav-link'
                            href='#' role='button'
                            aria-expanded='true'>" . $categoriaActual->getNombre() . "</a></li>";
                            }
                        ?>

                    
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="iniciarSesion.php" class="nav-link"
                            aria-disabled="true">Iniciar Sesion</a></li>
                </ul>
            </div>
        </div>
    </nav>


</body>

</html>