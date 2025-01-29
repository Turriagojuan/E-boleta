<?php
ob_start();
require("fpdf/fpdf.php");
require("qr/qrlib.php");

// Verifica si el idBoleta está presente en la URL
if (!isset($_GET['idBoleta'])) {
    die("Error: idBoleta no especificado.");
}

$idBoleta = $_GET['idBoleta'];

// Consultar todas las boletas del cliente (asumiendo que el cliente está en sesión)
$idCliente = $_SESSION['id'];
$boleta = new Boleta();
$boletas = $boleta->consultarBoleta($idCliente);

// Buscar la boleta específica
$boletaEncontrada = null;
foreach ($boletas as $boleta) {
    if ($boleta->getIdBoleta() == $idBoleta) {
        $boletaEncontrada = $boleta;
        break;
    }
}

// Verificar si la boleta fue encontrada
if ($boletaEncontrada === null) {
    die("Error: Boleta no encontrada.");
}

// Consultar el evento asociado a la boleta
$evento = new Evento($boletaEncontrada->getIdEvento());
$evento->consultar();

// Crear el contenido del QR
$qrContent = "Boleta ID: " . $boletaEncontrada->getIdBoleta() . "\n";
$qrContent .= "Nombre Usuario: " . $boletaEncontrada->getNombreUsuario() . "\n";
$qrContent .= "Evento: " . $evento->getNombre() . "\n";
$qrContent .= "Ciudad: " . $evento->getCiudad() . "\n";
$qrContent .= "Fecha: " . $evento->getFecha() . "\n";
$qrContent .= "Hora: " . $evento->getHora();

// Generar el QR y guardarlo en un archivo temporal
$qrFile = tempnam(sys_get_temp_dir(), 'qr_') . '.png';
QRcode::png($qrContent, $qrFile);

// Crear el PDF
$pdf = new FPDF("P", "mm", "Letter");
$pdf->AddPage();
$pdf->SetFont('Times', 'BI', 20);
$pdf->SetY(20);
$pdf->Cell(196, 10, 'Boleta de Evento', 0, 1, "C");

$pdf->SetY(50);
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(30, 10, "Boleta ID:", 0, 0, "L");
$pdf->SetFont('Times', '', 14);
$pdf->Cell(50, 10, $boletaEncontrada->getIdBoleta(), 0, 1, "L");

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(30, 10, "Nombre Usuario:", 0, 0, "L");
$pdf->SetFont('Times', '', 14);
$pdf->Cell(50, 10, $boletaEncontrada->getNombreUsuario(), 0, 1, "L");

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(30, 10, "Evento:", 0, 0, "L");
$pdf->SetFont('Times', '', 14);
$pdf->Cell(50, 10, $evento->getNombre(), 0, 1, "L");

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(30, 10, "Ciudad:", 0, 0, "L");
$pdf->SetFont('Times', '', 14);
$pdf->Cell(50, 10, $evento->getCiudad(), 0, 1, "L");

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(30, 10, "Fecha:", 0, 0, "L");
$pdf->SetFont('Times', '', 14);
$pdf->Cell(50, 10, $evento->getFecha(), 0, 1, "L");

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(30, 10, "Hora:", 0, 0, "L");
$pdf->SetFont('Times', '', 14);
$pdf->Cell(50, 10, $evento->getHora(), 0, 1, "L");

// Agregar el código QR al PDF
$pdf->Image($qrFile, 150, 50, 50, 50);

$pdf->Output();
ob_end_flush();

// Eliminar el archivo temporal del QR
unlink($qrFile);
?>