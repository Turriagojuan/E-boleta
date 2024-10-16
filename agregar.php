<?php
session_start();
require_once('logica/Proveedor.php');


if (!isset($_SESSION['id'])) {
    header('Location: iniciarSesion.php');
    exit();
}

$idProveedor = $_SESSION['id'];
$proveedor = new Proveedor($idProveedor);


function procesarEvento($nombre, $aforo, $ciudad, $direccion, $fecha, $hora, $descripcion,$precio, $idCategoria, $proveedor) {
    // Validar que los campos requeridos no estén vacíos
    if (empty($nombre) || empty($aforo) || empty($ciudad) || empty($direccion) || empty($fecha) || empty($hora) || empty($idCategoria) || empty($precio)) {
        return false; // Algún campo requerido está vacío
    }

    // Validar formatos (puedes añadir más validaciones según necesidad)
    if (!is_numeric($aforo) || $aforo <= 0) {
        return false; // El aforo debe ser un número positivo
    }

    // Si todo es válido, agregar el evento
    try {
        // Llama al método agregarEvento del proveedor
        $proveedor->agregarEvento($nombre, $aforo, $ciudad, $direccion, $fecha, $hora, $descripcion,$precio, $idCategoria);
        return true; // El evento fue agregado exitosamente
    } catch (Exception $e) {
        // Manejo de errores (podrías logear el error para depuración)
        return false; // Ocurrió un error al agregar el evento
    }
}

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

    echo "<pre>";
    echo "Nombre del evento: " . htmlspecialchars($nombre) . "\n";
    echo "Aforo: " . htmlspecialchars($aforo) . "\n";
    echo "Ciudad: " . htmlspecialchars($ciudad) . "\n";
    echo "Dirección: " . htmlspecialchars($direccion) . "\n";
    echo "Fecha: " . htmlspecialchars($fecha) . "\n";
    echo "Hora: " . htmlspecialchars($hora) . "\n";
    echo "Descripción: " . htmlspecialchars($descripcion) . "\n";
    echo "precio: " . htmlspecialchars($precio) . "\n";
    echo "ID Categoría: " . htmlspecialchars($idCategoria) . "\n";
    echo "</pre>";
    

    // Llamada al método procesarEvento para manejar la lógica
    if (procesarEvento($nombre, $aforo, $ciudad, $direccion, $fecha, $hora, $descripcion, $precio, $idCategoria, $proveedor)) {
        // Si el evento fue agregado exitosamente, redirigir con mensaje de éxito
        header('Location: sesionProveedor.php?mensaje=eventoAgregado');
    } else {
        // Si ocurrió un error, redirigir con un mensaje de error
        header('Location: agregarEvento.php?error=NoSePudoAgregarEvento');
    }
}
?>
