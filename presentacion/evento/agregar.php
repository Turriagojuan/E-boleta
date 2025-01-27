<?php

$rol = $_SESSION["rol"];
if($rol != "P"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));    
}

$idProveedor = $_SESSION['idProveedor']; // Obtener el ID del proveedor de la sesión
$proveedor = new Proveedor($idProveedor); // Crear una instancia del proveedor

// Función para procesar el evento
function procesarEvento($nombre, $aforo, $ciudad, $direccion, $fecha, $hora, $descripcion, $precio, $proveedor, $idCategoria) {
    // Validar que los campos requeridos no estén vacíos
    if (empty($nombre) || empty($aforo) || empty($ciudad) || empty($direccion) || empty($fecha) || empty($hora) || empty($idCategoria) || empty($precio)) {
        return false; // Algún campo requerido está vacío
    }

    // Validar que el aforo sea un número positivo
    if (!is_numeric($aforo) || $aforo <= 0) {
        return false; // El aforo debe ser un número positivo
    }

    // Si todo es válido, intentar agregar el evento
    try {
        $proveedor->agregarEvento($nombre, $aforo, $ciudad, $direccion, $fecha, $hora, $descripcion, $precio, $idCategoria); // Llamar al método agregarEvento
        return true; // El evento fue agregado exitosamente
    } catch (Exception $e) {
        // Manejo de errores (podrías logear el error para depuración)
        return false; // Ocurrió un error al agregar el evento
    }
}

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura los datos del formulario
    $nombre = $_POST['nombre'];
    $aforo = $_POST['aforo'];
    $ciudad = $_POST['ciudad'];
    $direccion = $_POST['direccion'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $idCategoria = $_POST['idCategoria'];

    // Imprimir datos para depuración
    echo "<pre>";
    echo "Nombre del evento: " . htmlspecialchars($nombre) . "\n";
    echo "Aforo: " . htmlspecialchars($aforo) . "\n";
    echo "Ciudad: " . htmlspecialchars($ciudad) . "\n";
    echo "Dirección: " . htmlspecialchars($direccion) . "\n";
    echo "Fecha: " . htmlspecialchars($fecha) . "\n";
    echo "Hora: " . htmlspecialchars($hora) . "\n";
    echo "Descripción: " . htmlspecialchars($descripcion) . "\n";
    echo "Precio: " . htmlspecialchars($precio) . "\n";
    echo "ID Categoría: " . htmlspecialchars($idCategoria) . "\n";
    echo "</pre>";

    // Llamada al método procesarEvento para manejar la lógica
    if (procesarEvento($nombre, $aforo, $ciudad, $direccion, $fecha, $hora, $descripcion, $precio, $idCategoria, $proveedor)) {
        // Si el evento fue agregado exitosamente, redirigir con mensaje de éxito
        header("Location: ?pid=" . base64_encode("presentacion/proveedor/sesionProveedor.php") . "&mensaje=eventoAgregado");
    } else {
        // Si ocurrió un error, redirigir con un mensaje de error
        header("Location: ?pid=" . base64_encode("presentacion/proveedor/sesionProveedor.php") . "&error=NoSePudoAgregarEvento");
    }
}
?>
