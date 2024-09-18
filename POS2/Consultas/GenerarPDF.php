<?php

require('Pdf/fpdf.php');
include ("Consultas.php");

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('https://saludapos.com/ArchivoPDF/LogoSaluda.png', 10, 10, 50, 30);
        // Salto de línea para evitar superposición con el contenido
        $this->Ln(35);
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Fuente Arial itálica
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Crear instancia de PDF con soporte UTF-8
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages(); // Para contar el número total de páginas
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Título
$pdf->Cell(0, 10, utf8_decode('Cotización'), 0, 1, 'C');

// Datos del cliente
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, utf8_decode('Nombre del Paciente: ' . $_POST['NombreCliente']), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Teléfono: ' . $_POST['TelefonoCliente']), 0, 1);

// Espacio antes de la tabla
$pdf->Ln(5);

// Establecer colores para los encabezados de la tabla
$pdf->SetFillColor(0, 102, 204); // Azul para fondo
$pdf->SetTextColor(255, 255, 255); // Blanco para texto
$pdf->SetFont('Arial', 'B', 12);

// Encabezados de la tabla
$pdf->Cell(110, 10, utf8_decode('Nombre'), 1, 0, 'C', true);
$pdf->Cell(30, 10, utf8_decode('Precio'), 1, 0, 'C', true);
$pdf->Cell(20, 10, utf8_decode('Cantidad'), 1, 0, 'C', true);
$pdf->Cell(30, 10, utf8_decode('Total'), 1, 1, 'C', true);

// Restablecer color de texto a negro para los datos
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 10);

// Iterar sobre los productos
$totalGeneral = 0;
$cotizacion = json_decode($_POST['cotizacion'], true);
foreach ($cotizacion as $producto) {
    $nombreProd = utf8_decode($producto['Nombre_Prod']);
    $precio = number_format(floatval($producto['Precio_Venta']), 2);
    $cantidad = intval($producto['Cantidad']);
    $total = number_format(floatval($producto['Total']), 2);

    // Salto de página si es necesario
    if ($pdf->GetY() > 260) { // Ajusta según el margen inferior deseado
        $pdf->AddPage();
    }

    // Imprimir fila de la tabla
    $pdf->MultiCell(110, 10, $nombreProd, 1);
    $yFinal = $pdf->GetY();
    $alturaFila = $yFinal - $pdf->GetY(); // Obtener altura

    $pdf->SetXY(120, $pdf->GetY() - $alturaFila); // Ajustar para que la siguiente celda esté en la misma línea
    $pdf->Cell(30, 10, $precio, 1, 0, 'C');
    $pdf->Cell(20, 10, $cantidad, 1, 0, 'C');
    $pdf->Cell(30, 10, $total, 1, 1, 'C');

    $totalGeneral += floatval($producto['Total']);
}

// Total general
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(160, 10, 'Total General:', 1);
$pdf->Cell(30, 10, number_format($totalGeneral, 2), 1);

// Agregar mensaje final
$pdf->Ln(10);
$pdf->SetFont('Arial', 'I', 10);
$pdf->MultiCell(0, 10, utf8_decode('Nota: Esta cotización tiene una validez de 24 horas. Después de este periodo, los productos están sujetos a cambios de precio.'), 0, 'C');

// Guardar el PDF
$folderPath = '/home/u155356178/domains/saludapos.com/public_html/ArchivoPDF/';
$filePath = $folderPath . $identificadorCotizacion . '.pdf';
if (!is_dir($folderPath)) {
    mkdir($folderPath, 0777, true);
}

$pdf->Output('F', $filePath);

// Guardar en base de datos
$relativeFilePath = 'ArchivoPDF/' . $identificadorCotizacion . '.pdf';
$sql = "UPDATE Cotizaciones_POS SET ArchivoPDF = '$relativeFilePath' WHERE Identificador = '$identificadorCotizacion'";

if ($conexion->query($sql) === TRUE) {
    echo json_encode(['message' => 'Cotización actualizada correctamente.', 'filePath' => $relativeFilePath]);
} else {
    echo json_encode(['error' => 'Error al actualizar la base de datos: ' . $conexion->error]);
}

$conexion->close();
?>
