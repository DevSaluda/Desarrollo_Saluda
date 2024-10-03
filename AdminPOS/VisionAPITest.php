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

    foreach ($lineas as $linea) {
        if (empty($proveedor)) {
            // Suponiendo que el nombre del proveedor está en la primera línea o en el logo
            $proveedor = trim($linea); // Captura la primera línea como proveedor
            continue;
        }

        // Prueba con múltiples expresiones regulares para productos
        if (preg_match('/(.+?)\s+(\d+)\s+([a-zA-Z0-9\-]+)\s+([\d,\.]+)\s+([\d,\.]+)/', trim($linea), $matches)) {
            // Caso 1: Producto, Cantidad, Lote, Precio e Importe en una sola línea
            $factura[] = [
                'producto' => $matches[1],
                'cantidad' => $matches[2],
                'lote' => $matches[3],
                'precio' => $matches[4],
                'importe' => $matches[5],
            ];
        } elseif (preg_match('/(.+?)\s+(\d+)\s+([\d,\.]+)\s+([\d,\.]+)/', trim($linea), $matches)) {
            // Caso 2: Producto, Cantidad, Precio e Importe en una sola línea (sin lote)
            $factura[] = [
                'producto' => $matches[1],
                'cantidad' => $matches[2],
                'lote' => 'No especificado', // No hay lote
                'precio' => $matches[3],
                'importe' => $matches[4],
            ];
        }
    }

    return [$proveedor, $factura];
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

        // Procesar el texto extraído para obtener proveedor y productos
        list($proveedor, $productos) = procesarTextoFactura($textoExtraido);

        // Mostrar el proveedor y la tabla de productos
        echo "<h2>Factura de: " . htmlspecialchars($proveedor) . "</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Nombre del Producto</th><th>Cantidad</th><th>Lote</th><th>Precio</th><th>Importe</th></tr>";

        foreach ($productos as $producto) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($producto['producto']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['cantidad']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['lote']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['precio']) . "</td>";
            echo "<td>" . htmlspecialchars($producto['importe']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
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
