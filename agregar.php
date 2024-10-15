<?php
session_start();
require_once('logica/Proveedor.php');


if (!isset($_SESSION['id'])) {
    header('Location: iniciarSesion.php');
    exit();
}

$idProveedor = $_SESSION['id'];
$proveedor = new Proveedor($idProveedor);



/**
 * Procesa el evento y lo agrega a la base de datos.
 *
 * @param string $nombre El nombre del evento.
 * @param int $aforo El aforo del evento.
 * @param string $ciudad La ciudad donde se realizará el evento.
 * @param string $direccion La dirección del evento.
 * @param string $fecha La fecha del evento.
 * @param string $hora La hora del evento.
 * @param string $descripcion Una breve descripción del evento.
 * @param int $idCategoria La categoría del evento (llave foránea).
 * @param Proveedor $proveedor El objeto Proveedor que agrega el evento.
 * @return bool Retorna true si el evento fue procesado correctamente, false si ocurrió un error.
 */
function procesarEvento($nombre, $aforo, $ciudad, $direccion, $fecha, $hora, $descripcion, $idCategoria, $proveedor) {
    // Validar que los campos requeridos no estén vacíos
    if (empty($nombre) || empty($aforo) || empty($ciudad) || empty($direccion) || empty($fecha) || empty($hora) || empty($idCategoria)) {
        return false; // Algún campo requerido está vacío
    }

    // Validar formatos (puedes añadir más validaciones según necesidad)
    if (!is_numeric($aforo) || $aforo <= 0) {
        return false; // El aforo debe ser un número positivo
    }

    // Si todo es válido, agregar el evento
    try {
        // Llama al método agregarEvento del proveedor
        $proveedor->agregarEvento($nombre, $aforo, $ciudad, $direccion, $fecha, $hora, $descripcion, $idCategoria);
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
    $idCategoria = $_POST['idCategoria'];

    echo "<pre>";
    echo "Nombre del evento: " . htmlspecialchars($nombre) . "\n";
    echo "Aforo: " . htmlspecialchars($aforo) . "\n";
    echo "Ciudad: " . htmlspecialchars($ciudad) . "\n";
    echo "Dirección: " . htmlspecialchars($direccion) . "\n";
    echo "Fecha: " . htmlspecialchars($fecha) . "\n";
    echo "Hora: " . htmlspecialchars($hora) . "\n";
    echo "Descripción: " . htmlspecialchars($descripcion) . "\n";
    echo "ID Categoría: " . htmlspecialchars($idCategoria) . "\n";
    echo "</pre>";
    
    // Llamada al método procesarEvento para manejar la lógica
    if (procesarEvento($nombre, $aforo, $ciudad, $direccion, $fecha, $hora, $descripcion, $idCategoria, $proveedor)) {
        // Si el evento fue agregado exitosamente, redirigir con mensaje de éxito
        header('Location: sesionProveedor.php?mensaje=eventoAgregado');
    } else {
        // Si ocurrió un error, redirigir con un mensaje de error
        header('Location: agregarEvento.php?error=NoSePudoAgregarEvento');
    }
}
?>
