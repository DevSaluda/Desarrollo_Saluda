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

// Crear instancia de FPDF con soporte UTF-8
$pdf = new FPDF('P', 'mm', 'A4');

// Función para dibujar el encabezado de la tabla
function HeaderTable($pdf) {
    $pdf->SetFillColor(0, 102, 204); // Azul para fondo
    $pdf->SetTextColor(255, 255, 255); // Blanco para texto
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(110, 10, utf8_decode('Nombre'), 1, 0, 'C', true); 
    $pdf->Cell(30, 10, utf8_decode('Precio'), 1, 0, 'C', true);
    $pdf->Cell(20, 10, utf8_decode('Cantidad'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, utf8_decode('Total'), 1, 1, 'C', true);
    $pdf->SetFont('Arial', '', 10);
    // Restablecer color de texto a negro para el resto de la página
    $pdf->SetTextColor(0, 0, 0);
}

// Agregar una nueva página
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Agregar logo en la parte superior
$logoPath = 'https://saludapos.com/ArchivoPDF/LogoSaluda.png';
$pdf->Image($logoPath, 10, 10, 50, 30); // Ajusta el tamaño y la posición según tus necesidades

// Mover el cursor debajo del logo para evitar sobreposición con el título
$pdf->Ln(35); // Ajusta el valor de acuerdo a la altura del logo

// Agregar título
$pdf->Cell(0, 10, utf8_decode('Cotización'), 0, 1, 'C');

// Agregar información del cliente con fuente más pequeña
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, utf8_decode('Nombre del Paciente: ' . $nombreCliente), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Teléfono: ' . $telefonoCliente), 0, 1);

// Agregar espacio antes de la tabla
$pdf->Ln(5);

// Dibujar el encabezado de la tabla
HeaderTable($pdf);

// Restablecer color de texto a negro para los datos
$pdf->SetTextColor(0, 0, 0);

// Iterar sobre los productos para agregarlos a la tabla
$totalGeneral = 0;
$pdf->SetFont('Arial', '', 10); // Reducir tamaño de la fuente para el contenido

function getMultiCellHeight($pdf, $w, $h, $text) {
    // Dividir el texto en líneas para contar cuántas líneas ocupará
    $lines = $pdf->GetStringWidth($text) / $w;
    $lines = ceil($lines); // Redondear hacia arriba para obtener líneas completas

    // Retornar la altura total basada en el número de líneas y la altura por línea
    return $lines * $h;
}

// En el bucle que imprime los productos
foreach ($cotizacion as $producto) {
    $nombreProd = utf8_decode($producto['Nombre_Prod']);
    $precio = number_format(floatval($producto['Precio_Venta']), 2);
    $cantidad = intval($producto['Cantidad']);
    $total = number_format(floatval($producto['Total']), 2);

    // Obtener la cantidad de líneas que ocupará el nombre del producto
    $yInicial = $pdf->GetY();

    // Calcular la altura estimada de la celda
    $multiCellHeight = getMultiCellHeight($pdf, 110, 10, $nombreProd);

    // Verificar si hay suficiente espacio en la página para el nombre del producto y las celdas adyacentes
    if ($pdf->GetY() + $multiCellHeight > $pdf->GetPageHeight() - 20) {
        $pdf->AddPage(); // Hacer el salto de página antes de imprimir
        HeaderTable($pdf); // Repetir el encabezado en la nueva página
        
        // Restablecer el color de texto a negro después de agregar una nueva página
        $pdf->SetTextColor(0, 0, 0);
        $yInicial = $pdf->GetY(); // Actualizar la posición inicial tras el salto
    }
    

    // Imprimir el nombre del producto con MultiCell
    $pdf->MultiCell(110, 10, $nombreProd, 1);

    $yFinal = $pdf->GetY();
    $alturaFila = $yFinal - $yInicial;

    // Establecer la posición para las siguientes celdas en la misma fila
    $pdf->SetXY(120, $yInicial); // Colocar las celdas de precio, cantidad y total al lado de la celda de nombre

    // Celdas de precio, cantidad y total con la misma altura que el nombre
    $pdf->Cell(30, $alturaFila, $precio, 1, 0, 'C');
    $pdf->Cell(20, $alturaFila, $cantidad, 1, 0, 'C');
    $pdf->Cell(30, $alturaFila, $total, 1, 1, 'C'); // Mueve el cursor a la siguiente fila

    $totalGeneral += floatval($producto['Total']);
}


// Total general
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(160, 10, 'Total General:', 1);
$pdf->Cell(30, 10, number_format($totalGeneral, 2), 1);

// Agregar espacio antes del mensaje final
$pdf->Ln(10);

// Mensaje de validez de la cotización
$pdf->SetFont('Arial', 'I', 10); // Cambiar a cursiva para el mensaje
$pdf->MultiCell(0, 10, utf8_decode('Nota: Esta cotización tiene una validez de 24 horas. Después de este periodo, los productos están sujetos a cambios de precio.'), 0, 'C');

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
$relativeFilePath = 'ArchivoPDF/' . "COT-$identificadorCotizacion" . '.pdf';

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
