<?php
require('Pdf\fpdf.php');

// Recibir los datos de la cotización desde una solicitud POST
$identificadorCotizacion = $_POST['IdentificadorCotizacion'];
$nombreCliente = $_POST['NombreCliente'];
$telefonoCliente = $_POST['TelefonoCliente'];
$cotizacion = $_POST['cotizacion']; // Asegúrate de decodificar el JSON en el backend si es necesario

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Agregar título
$pdf->Cell(0, 10, 'Cotización', 0, 1, 'C');

// Agregar información del cliente
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Nombre del Paciente: ' . $nombreCliente, 0, 1);
$pdf->Cell(0, 10, 'Teléfono: ' . $telefonoCliente, 0, 1);

// Agregar productos
$pdf->Cell(0, 10, '', 0, 1); // Espacio en blanco
$pdf->Cell(0, 10, 'Productos:', 0, 1);
$pdf->Cell(30, 10, 'Código', 1);
$pdf->Cell(80, 10, 'Nombre', 1);
$pdf->Cell(30, 10, 'Precio', 1);
$pdf->Cell(30, 10, 'Cantidad', 1);
$pdf->Cell(30, 10, 'Total', 1);
$pdf->Ln();

$totalGeneral = 0;
foreach (json_decode($cotizacion, true) as $producto) {
    $totalGeneral += $producto['Total'];
    $pdf->Cell(30, 10, $producto['Cod_Barra'], 1);
    $pdf->Cell(80, 10, $producto['Nombre_Prod'], 1);
    $pdf->Cell(30, 10, $producto['Precio_Venta'], 1);
    $pdf->Cell(30, 10, $producto['Cantidad'], 1);
    $pdf->Cell(30, 10, $producto['Total'], 1);
    $pdf->Ln();
}

// Total general
$pdf->Cell(140, 10, 'Total General:', 1);
$pdf->Cell(30, 10, $totalGeneral, 1);

$folderPath = 'ArchivoPDF/';
$filePath = $folderPath . $identificadorCotizacion . '.pdf';
$pdf->Output('F', $filePath);

echo json_encode(['filePath' => $filePath]);
?>
