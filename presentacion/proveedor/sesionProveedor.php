<?php
// Verificar si el proveedor está autenticado
if(!isset($_SESSION["idProveedor"])){
    header("Location: ?pid=" . base64_encode("presentacion/iniciarSesion.php")); // Redirigir a la página de inicio de sesión si no está autenticado
}

$id = $_SESSION["idProveedor"]; // Obtener el ID del proveedor de la sesión

$proveedor = new Proveedor($id); // Crear un objeto Proveedor con el ID del proveedor
$proveedor->consultar(); // Consultar la información del proveedor
?>
<html>
<body>
    <?php include("presentacion/encabezado.php"); ?> <!-- Incluir el encabezado de la página -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="img/logo.png" width="50" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Evento</a>
                        <ul class="dropdown-menu">
                            <li><a class='dropdown-item' href="?pid=<?php echo base64_encode("presentacion/evento/agregarEvento.php")?>">Nuevo Evento</a></li> <!-- Enlace para agregar un nuevo evento -->
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $proveedor->getNombre() ?> <!-- Mostrar el nombre del proveedor autenticado -->
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class='dropdown-item' href='?cerrarSesion=true'>Cerrar Sesion</a></li> <!-- Enlace para cerrar sesión -->
                        </ul>
                    </li>
                </ul>			
            </div>
        </div>
    </nav>
    
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <div class="card border-primary">
                    <div class="card-header text-bg-info">
                        <h4>Sesion Proveedor</h4> <!-- Título de la sección -->
                    </div>
                    <div class="card-body">
                        <p>Bienvenido <?php echo $proveedor->getNombre() ?></p> <!-- Mensaje de bienvenida al proveedor -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
