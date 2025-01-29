<?php
ob_start();
require("fpdf/fpdf.php");
if (!isset($_GET['idFactura'])) {
    die("Error: idFactura no especificado.");
}
$idFactura = $_GET['idFactura'];
$factura = new Factura($idFactura);
$factura->consultar();
$evento = new Evento($factura->getIdEvento());
$evento->consultar();
$pdf = new FPDF("P", "mm", "Letter");
$pdf->AddPage();
$pdf->SetMargins(20, 20, 20);

// Encabezado
$pdf->SetFont('Times', 'BI', 20);
$pdf->SetTextColor(0, 51, 102);
$pdf->Cell(0, 10, 'Factura de Compra', 0, 1, "C");
$pdf->Ln(10);

// Información de la factura
$pdf->SetFont('Times', 'B', 14);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(30, 10, "Factura ID:", 0, 0, "L");
$pdf->SetFont('Times', '', 14);
$pdf->Cell(50, 10, $factura->getIdFactura(), 0, 1, "L");

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(30, 10, "Fecha:", 0, 0, "L");
$pdf->SetFont('Times', '', 14);
$pdf->Cell(50, 10, $factura->getFecha(), 0, 1, "L");

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(30, 10, "Hora:", 0, 0, "L");
$pdf->SetFont('Times', '', 14);
$pdf->Cell(50, 10, $factura->getHora(), 0, 1, "L");

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(30, 10, "Total:", 0, 0, "L");
$pdf->SetFont('Times', '', 14);
$pdf->Cell(50, 10, "$" . number_format($factura->getTotal(), 2), 0, 1, "L");

$pdf->Ln(10);

// Detalles del evento
$pdf->SetFont('Times', 'BI', 16);
$pdf->SetTextColor(0, 51, 102);
$pdf->Cell(0, 10, 'Detalles del Evento', 0, 1, "C");
$pdf->Ln(5);

$pdf->SetFont('Times', 'B', 14);
$pdf->SetTextColor(0, 0, 0);
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

$pdf->Output();
ob_end_flush();
?>