<?php
require('Pdf/fpdf.php');
include ("Consultas.php");

class PDF extends FPDF {
    // Definir el header
    function Header() {
        // Agregar logo
        $this->Image('https://saludapos.com/ArchivoPDF/LogoSaluda.png', 10, 10, 50, 30);
        // Mover a la derecha para evitar sobreposición con el logo
        $this->Ln(35);
        // Agregar título
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, utf8_decode('Cotización'), 0, 1, 'C');
        // Espacio debajo del título
        $this->Ln(10);
    }

    // Definir el footer
    function Footer() {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Fuente Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . ' de {nb}', 0, 0, 'C');
    }
}

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

// Crear instancia de FPDF con soporte UTF-8
$pdf = new PDF();
$pdf->AliasNbPages();  // Activar el conteo total de páginas
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Agregar información del cliente
$pdf->Cell(0, 10, utf8_decode('Nombre del Paciente: ' . $nombreCliente), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Teléfono: ' . $telefonoCliente), 0, 1);

// Agregar espacio antes de la tabla
$pdf->Ln(5);

// Establecer colores para los encabezados de la tabla
$pdf->SetFillColor(0, 102, 204); // Azul para fondo
$pdf->SetTextColor(255, 255, 255); // Blanco para texto

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 10, utf8_decode('Nombre'), 1, 0, 'C', true); // Reducir ancho de Nombre
$pdf->Cell(30, 10, utf8_decode('Precio'), 1, 0, 'C', true);
$pdf->Cell(20, 10, utf8_decode('Cantidad'), 1, 0, 'C', true);
$pdf->Cell(30, 10, utf8_decode('Total'), 1, 1, 'C', true);

// Restablecer color de texto a negro para los datos
$pdf->SetTextColor(0, 0, 0);

// Iterar sobre los productos para agregarlos a la tabla
$totalGeneral = 0;
$pdf->SetFont('Arial', '', 10);
foreach ($cotizacion as $producto) {
    $nombreProd = utf8_decode($producto['Nombre_Prod']);
    $precio = number_format(floatval($producto['Precio_Venta']), 2);
    $cantidad = intval($producto['Cantidad']);
    $total = number_format(floatval($producto['Total']), 2);

    // Altura inicial
    $yInicial = $pdf->GetY();

    // Ajustar el nombre del producto para dividirse en líneas con MultiCell
    $pdf->MultiCell(90, 10, utf8_decode($nombreProd), 1); // Ajustar a 90 de ancho
    $yFinal = $pdf->GetY();

    // Calcular la altura usada por la celda de nombre
    $alturaFila = $yFinal - $yInicial;

    // Colocar las demás celdas en la misma fila
    $pdf->SetXY(100, $yInicial); // Posición después de la columna Nombre

    // Precio, cantidad y total con la misma altura
    $pdf->Cell(30, $alturaFila, $precio, 1, 0, 'C');
    $pdf->Cell(20, $alturaFila, $cantidad, 1, 0, 'C');
    $pdf->Cell(30, $alturaFila, $total, 1, 1, 'C');

    // Sumar al total general
    $totalGeneral += floatval($producto['Total']);
}

// Total general
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(140, 10, 'Total General:', 1); // Aumentar a 140 el ancho total
$pdf->Cell(30, 10, number_format($totalGeneral, 2), 1);

// Agregar espacio antes del mensaje final
$pdf->Ln(10);

// Mensaje de validez de la cotización
$pdf->SetFont('Arial', 'I', 10);
$pdf->MultiCell(0, 10, utf8_decode('Nota: Esta cotización tiene una validez de 24 horas. Después de este periodo, los productos están sujetos a cambios de precio.'), 0, 'C');

// Guardar el PDF
$folderPath = '/home/u155356178/domains/saludapos.com/public_html/ArchivoPDF/';
$filePath = $folderPath . $identificadorCotizacion . '.pdf';

// Verificar si la carpeta existe, y si no, crearla
if (!is_dir($folderPath)) {
    mkdir($folderPath, 0777, true);
}

// Guardar el archivo PDF
if (!$pdf->Output('F', $filePath)) {
    echo json_encode(['error' => 'Error al generar el PDF']);
    exit;
}

// Definir la ruta relativa que se guardará en la base de datos
$relativeFilePath = 'ArchivoPDF/' . $identificadorCotizacion . '.pdf';

// Actualizar la base de datos
$sql = "UPDATE Cotizaciones_POS SET ArchivoPDF = '$relativeFilePath' WHERE Identificador = '$identificadorCotizacion'";

if ($conexion->query($sql) === TRUE) {
    echo json_encode(['message' => 'Cotización actualizada correctamente.', 'filePath' => $relativeFilePath]);
} else {
    echo json_encode(['error' => 'Error al actualizar la base de datos: ' . $conexion->error]);
}

// Cerrar la conexión
$conexion->close();
