<?php
require('Pdf/fpdf.php');
include ("Consultas.php");
// Recibir los datos de la cotización desde una solicitud POST
$identificadorCotizacion = $_POST['IdentificadorCotizacion'];
$nombreCliente = $_POST['NombreCliente'];
$telefonoCliente = $_POST['TelefonoCliente'];

// Decodificar la cotización si llega en formato JSON
$cotizacion = json_decode($_POST['cotizacion'], true);

// Verificar si se decodificó correctamente
if (empty($cotizacion)) {
    echo json_encode(['error' => 'Error al decodificar la cotización.']);
    exit;
}

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
foreach ($cotizacion as $producto) {
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

// Definir ruta absoluta para guardar el archivo PDF
$folderPath = '/home/u155356178/domains/saludapos.com/public_html/ArchivoPDF/';
$filePath = $folderPath . $identificadorCotizacion . '.pdf';

// Verificar si la carpeta existe, y si no, crearla
if (!is_dir($folderPath)) {
    mkdir($folderPath, 0777, true);
}

// Guardar el PDF y verificar errores
if (!$pdf->Output('F', $filePath)) {
    echo json_encode(['error' => 'Error al generar el PDF']);
    exit;
}



// Definir la ruta relativa que se guardará en la base de datos
$relativeFilePath = 'ArchivoPDF/' . $identificadorCotizacion . '.pdf';

// Realizar el UPDATE en la tabla Cotizaciones_POS
$sql = "UPDATE Cotizaciones_POS SET ArchivoPDF = '$relativeFilePath' WHERE Identificador = '$identificadorCotizacion'";

if ($conexion->query($sql) === TRUE) {
    echo json_encode(['message' => 'Cotización actualizada correctamente.', 'filePath' => $relativeFilePath]);
} else {
    echo json_encode(['error' => 'Error al actualizar la base de datos: ' . $conexion->error]);
}

// Cerrar la conexión
$conexion->close();
?>
