<?php
// Incluye el autoload de Composer para cargar las dependencias
require 'vendor/autoload.php';

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

// Función para limpiar el texto extraído del OCR
function limpiarTextoOCR($texto) {
    // Elimina espacios extra entre palabras
    $texto = preg_replace('/\s+/', ' ', $texto);

    // Normaliza saltos de línea
    $texto = str_replace("\r", "\n", $texto); // Asegúrate de que los saltos de línea estén consistentes
    $texto = trim($texto); // Elimina espacios al principio y al final

    return $texto;
}

// Función para extraer texto de una imagen usando Google Cloud Vision API
function extraerTextoDeImagen($rutaImagen) {
    // Configurar la ruta a las credenciales JSON
    putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/../app-saluda-966447541c3c.json'); // Ruta correcta a las credenciales

    // Crear un cliente para Google Cloud Vision
    $imageAnnotator = new ImageAnnotatorClient();

    try {
        // Leer el archivo de la imagen
        $image = file_get_contents($rutaImagen);

        // Enviar la imagen a Google Cloud Vision para realizar detección de texto en documentos
        $response = $imageAnnotator->documentTextDetection($image);
        $fullTextAnnotation = $response->getFullTextAnnotation();

        // Retornar el texto completo detectado y limpiar el texto
        $textoExtraido = $fullTextAnnotation ? $fullTextAnnotation->getText() : 'No se detectó texto en la imagen.';
        return limpiarTextoOCR($textoExtraido);

    } finally {
        $imageAnnotator->close();
    }
}

// Función para procesar el texto extraído y extraer datos relevantes (productos, cantidad, lote, precio e importe)
function procesarTextoFactura($texto) {
    $lineas = explode("\n", $texto);
    $factura = [];
    $proveedor = '';
    $detallesTotales = [];
    
    foreach ($lineas as $linea) {
        if (empty($proveedor) && strpos($linea, 'Marzam') !== false) {
            // Busca la línea que contiene el nombre del proveedor
            $proveedor = trim($linea); // Captura la primera línea como proveedor
            continue;
        }

        // Buscar líneas con productos usando regex
        if (preg_match('/^\d{5}\s+(.+?)\s+(\d+)\s+([A-Z0-9]+)\s+([\d,\.]+)\s+([\d,\.]+)$/', trim($linea), $matches)) {
            // Caso Producto, Cantidad, Lote, Precio unitario, Precio total
            $factura[] = [
                'producto' => $matches[1],
                'cantidad' => $matches[2],
                'lote' => $matches[3],
                'precio_unitario' => $matches[4],
                'importe' => $matches[5],
            ];
        }

        // Buscar las líneas de totales
        if (strpos($linea, 'TOTAL NETO') !== false || strpos($linea, 'I.V.A.') !== false) {
            $detallesTotales[] = trim($linea);
        }
    }

    return [$proveedor, $factura, $detallesTotales];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
    $nombreArchivo = $_FILES['archivo']['name'];
    $rutaArchivo = __DIR__ . '/../uploads/' . $nombreArchivo; // Corrige la ruta aquí

    // Mover el archivo subido a la carpeta 'uploads'
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
        // Procesar la imagen para extraer texto
        $textoExtraido = extraerTextoDeImagen($rutaArchivo);

        // Mostrar el texto extraído antes de procesar
        echo "<h2>Texto Extraído:</h2>";
        echo "<pre>" . htmlspecialchars($textoExtraido) . "</pre>";

        // Procesar el texto extraído para obtener proveedor, productos y totales
        list($proveedor, $productos, $detallesTotales) = procesarTextoFactura($textoExtraido);

        // Mostrar el proveedor y la tabla de productos
        echo "<h2>Factura de: " . htmlspecialchars($proveedor) . "</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Nombre del Producto</th><th>Cantidad</th><th>Lote</th><th>Precio Unitario</th><th>Importe</th></tr>";

        foreach ($productos as $producto) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($producto['producto']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['cantidad']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['lote']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['precio_unitario']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['importe']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        // Mostrar los detalles totales
        echo "<h2>Detalles Totales:</h2>";
        echo "<pre>" . htmlspecialchars(implode("\n", $detallesTotales)) . "</pre>";
    } else {
        echo "Hubo un error al subir la imagen.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen para OCR</title>
</head>
<body>
    <h1>Subir una imagen para extraer texto (OCR)</h1>

    <form action="" method="post" enctype="multipart/form-data">
        Selecciona una imagen:
        <input type="file" name="archivo" accept="image/*" required>
        <input type="submit" value="Subir Imagen">
    </form>
</body>
</html>
