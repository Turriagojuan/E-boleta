<?php 
$proveedor = new Proveedor($_SESSION["id"]);
$proveedor -> consultar();
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
	<div class="container">
		<a class="navbar-brand" href="?pid=<?php echo base64_encode("presentacion/sesionProveedor.php")?>"><img src="img/logo.png" width="50" /></a>
		<button class="navbar-toggler" type="button"
			data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav me-auto">
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" role="button" data-bs-toggle="dropdown"
					aria-expanded="false">Evento</a>
					<ul class="dropdown-menu">
                        <li><a class='dropdown-item' href='?pid=<?php echo base64_encode("presentacion/evento/agregarEvento.php")?>'>Nuevo Evento</a></li>
                        <li><a class='dropdown-item' href='?pid=<?php echo base64_encode("presentacion/evento/buscarEvento.php")?>'>Buscar Eventos</a></li>
					</ul></li>
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" role="button" data-bs-toggle="dropdown"
					aria-expanded="false">Graficas</a>
					<ul class="dropdown-menu">
                        <li><a class='dropdown-item' href='?pid=<?php echo base64_encode("presentacion/evento/graficaEventos.php")?>'>Eventos</a></li>
						<li><a class='dropdown-item' href='?pid=<?php echo base64_encode("presentacion/evento/graficaEstadisticasVentas.php")?>'>Ventas</a></li>
					</ul></li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" role="button" data-bs-toggle="dropdown"
					aria-expanded="false"><?php echo $proveedor -> getNombre() ?></a>
					<ul class="dropdown-menu">
                        <li><a class='dropdown-item' href='?cerrarSesion=true'>Cerrar Sesion</a></li>
					</ul></li>
			</ul>			
		</div>
	</div>
</nav>