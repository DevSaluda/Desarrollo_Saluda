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

// Establecer fuente y tamaño para el título
$pdf->SetFont('Arial', 'B', 16);

// Agregar título
$pdf->Cell(0, 10, 'Cotización', 0, 1, 'C');

// Agregar información del cliente con fuente más pequeña
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, 'Nombre del Paciente: ' . $nombreCliente, 0, 1);
$pdf->Cell(0, 10, 'Teléfono: ' . $telefonoCliente, 0, 1);

// Agregar espacio antes de la tabla
$pdf->Ln(5);

// Establecer colores para los encabezados de la tabla
$pdf->SetFillColor(0, 102, 204); // Azul para fondo
$pdf->SetTextColor(255, 255, 255); // Blanco para texto

// Encabezados de la tabla con fondo azul y texto blanco
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(80, 10, 'Nombre', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Precio', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Total', 1, 1, 'C', true);

// Restablecer color de texto a negro para los datos
$pdf->SetTextColor(0, 0, 0);

// Iterar sobre los productos para agregarlos a la tabla
$totalGeneral = 0;
$pdf->SetFont('Arial', '', 10); // Reducir tamaño de la fuente para el contenido
foreach ($cotizacion as $producto) {
    $nombreProd = utf8_decode($producto['Nombre_Prod']);
    $precio = number_format(floatval($producto['Precio_Venta']), 2);
    $cantidad = intval($producto['Cantidad']);
    $total = number_format(floatval($producto['Total']), 2);

    // Obtener la cantidad de líneas que ocupará el nombre del producto
    $yInicial = $pdf->GetY();
    $pdf->MultiCell(80, 10, $nombreProd, 1);
    $yFinal = $pdf->GetY();

    // Altura utilizada por la MultiCell
    $alturaFila = $yFinal - $yInicial;

    // Establecer la posición para las siguientes celdas en la misma fila
    $pdf->SetXY(90, $yInicial);  // Ajusta 90 como inicio después de la celda de nombre

    // Celdas de precio, cantidad y total con la misma altura
    $pdf->Cell(30, $alturaFila, $precio, 1, 0, 'C');
    $pdf->Cell(30, $alturaFila, $cantidad, 1, 0, 'C');
    $pdf->Cell(30, $alturaFila, $total, 1, 1, 'C'); // Mueve el cursor a la siguiente fila con 1

    $totalGeneral += floatval($producto['Total']);
}

// Total general
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(140, 10, 'Total General:', 1);
$pdf->Cell(30, 10, number_format($totalGeneral, 2), 1);

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
