<nav class="navbar navbar-expand-lg bg-body-tertiary">
	<div class="container">
		<!-- Logo -->
		<a class="navbar-brand" href="#"><img src="img/logo.png" width="50" /></a>
		
		<!-- Botón de colapso para móviles -->
		<button class="navbar-toggler" type="button"
			data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav me-auto">
				<li class="nav-item">
					<a class="nav-link" href='?pid=<?php echo base64_encode("presentacion/cliente/compras.php")?>'>Compras</a>
				</li>
			</ul>

			<!-- Ícono del carrito de compras -->
			<a href='?pid=<?php echo base64_encode("presentacion/compra/verCarrito.php")?>'  class="nav-link">
				<img src="img/carro.svg" width="40" alt="Carrito de compras" class="me-3">
			</a>

			<!-- Usuario -->
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
						aria-expanded="false"><?php echo $cliente->getNombre() ?></a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="?cerrarSesion=true">Cerrar Sesión</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
