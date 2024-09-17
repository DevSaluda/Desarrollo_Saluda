<?php
require('Pdf/fpdf.php');
include("Consultas.php");

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

// Crear instancia de FPDF con orientación vertical (P), unidad en milímetros y tamaño de página A4
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// Estilo del encabezado: fuente grande y centrada
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetTextColor(33, 136, 56); // Color verde oscuro
$pdf->Cell(0, 15, 'Cotización de Servicios', 0, 1, 'C');
$pdf->Ln(10); // Espacio después del título

// Información del cliente: fuente más pequeña y alineada a la izquierda
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0); // Negro para el texto regular
$pdf->Cell(0, 10, 'Nombre del Paciente: ' . $nombreCliente, 0, 1);
$pdf->Cell(0, 10, 'Teléfono: ' . $telefonoCliente, 0, 1);
$pdf->Ln(5); // Espacio después de la info del cliente

// Sección de productos: encabezado estilizado con bordes y fondo gris claro
$pdf->SetFillColor(230, 230, 230); // Fondo gris claro para el encabezado de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(80, 10, 'Nombre', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Precio', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Total', 1, 1, 'C', true);

// Contenido de la tabla de productos
$pdf->SetFont('Arial', '', 12);
$totalGeneral = 0;
foreach ($cotizacion as $producto) {
    // Cálculo del total
    $totalGeneral += floatval($producto['Total']);
    
    // Nombre del producto con ajuste de texto para longitud variable
    $pdf->MultiCell(80, 10, utf8_decode($producto['Nombre_Prod']), 1);
    
    // Ajustamos las celdas siguientes en la misma línea que el producto
    $pdf->Cell(80, -10, '', 0, 0); // Espacio para el nombre del producto
    $pdf->Cell(30, 10, number_format(floatval($producto['Precio_Venta']), 2), 1, 0, 'C');
    $pdf->Cell(30, 10, intval($producto['Cantidad']), 1, 0, 'C');
    $pdf->Cell(30, 10, number_format(floatval($producto['Total']), 2), 1, 1, 'C');
}

// Mostrar el total general en negrita y resaltado
$pdf->Ln(5); // Espacio antes del total general
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(140, 10, 'Total General:', 1, 0, 'R');
$pdf->SetTextColor(33, 136, 56); // Resaltar en verde oscuro
$pdf->Cell(30, 10, '$' . number_format($totalGeneral, 2), 1, 1, 'C');

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

// Actualizar la base de datos con la ruta del archivo PDF
$sql = "UPDATE Cotizaciones_POS SET ArchivoPDF = '$relativeFilePath' WHERE Identificador = '$identificadorCotizacion'";

if ($conexion->query($sql) === TRUE) {
    echo json_encode(['message' => 'Cotización actualizada correctamente.', 'filePath' => $relativeFilePath]);
} else {
    echo json_encode(['error' => 'Error al actualizar la base de datos: ' . $conexion->error]);
}

// Cerrar la conexión
$conexion->close();
?>
