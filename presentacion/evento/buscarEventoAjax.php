<?php 
$filtro = $_GET["filtro"];
$evento = new Evento();
$eventos = $evento -> buscar($filtro);
?>
<div class="container">
	<div class="row mb-3">
		<div class="col">		
			<?php 
			if(count($eventos) > 0){
                echo "<table class='table table-striped table-hover'>";
				echo "<tr>";
				echo "<th>Categoria</th>";
				echo "<th>Nombre</th>";
				echo "<th>Cantidad</th>";
				echo "<th>Precio</th>";
				echo "<th>Imagen</th>";
				echo "<th></th>";
				echo "</tr>";
				
				foreach ($eventos as $eventoActual){
				    echo "<tr>";
				    echo "<td>" . $eventoActual -> getCategoria() -> getNombre() . "</td>";
				    echo "<td>" . str_ireplace($filtro, "<strong>" . substr($eventoActual -> getNombre(), stripos($eventoActual -> getNombre(), $filtro), strlen($filtro)) . "</strong>", $eventoActual -> getNombre()) . "</td>";
				    echo "<td>" . $eventoActual -> getCantidad() . "</td>";
				    echo "<td>" . $eventoActual -> getPrecioVenta() . "</td>";
				    echo "<td>" . (($eventoActual -> getImagen() != "")?"<img src='imagenes/" . $eventoActual -> getImagen() . "' height='50px' />":"") . "</td>";
				    echo "<td><a href='?pid=" . base64_encode("presentacion/evento/editarEvento.php") . "&idEvento=" . $eventoActual -> getIdEvento() ."'><i class='fas fa-edit'></i></a> 
                              <a href='?pid=" . base64_encode("presentacion/evento/editarEventoImagen.php") . "&idEvento=" . $eventoActual -> getIdEvento() ."'><i class='fas fa-image'></i></a></td>";
				    echo "</tr>";
				}
				echo "</table>";
			} else {
			    echo "<div class='alert alert-danger mt-3' role='alert'>No hay resultados</div>";
			}
			?>
		</div>
	</div>
</div>