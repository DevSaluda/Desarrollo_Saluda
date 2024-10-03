<?php
// Incluye el autoload de Composer para cargar las dependencias
require 'vendor/autoload.php';

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

// Función para extraer el texto de una imagen usando Google Cloud Vision API
function obtenerTextoDeOCR($rutaImagen) {
    // Configurar la ruta a las credenciales JSON
    putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/../app-saluda-966447541c3c.json'); // Ajusta la ruta correcta

    // Crear un cliente para Google Cloud Vision
    $vision = new ImageAnnotatorClient();

    try {
        // Leer el archivo de la imagen
        $image = file_get_contents($rutaImagen);

        // Enviar la imagen a Google Cloud Vision para realizar detección de texto en documentos
        $response = $vision->documentTextDetection($image);
        $fullTextAnnotation = $response->getFullTextAnnotation();

        // Retornar el texto completo detectado
        return $fullTextAnnotation ? $fullTextAnnotation->getText() : 'No se detectó texto en la imagen.';
    } finally {
        $vision->close();
    }
}

// Función para extraer datos usando expresiones regulares
function extraer_datos($texto) {
    // Array para almacenar los datos extraídos
    $datos = [];

    // Extraer información del cliente
    preg_match("/CLIENTE\s([A-Z0-9]+)\s(.+?)\s(.+)/", $texto, $cliente);
    $datos['cliente_id'] = isset($cliente[1]) ? $cliente[1] : '';
    $datos['cliente_nombre'] = isset($cliente[2]) ? $cliente[2] : '';
    $datos['cliente_direccion'] = isset($cliente[3]) ? $cliente[3] : '';

    // Extraer información de los productos
    preg_match_all("/(\d{4})\s(.+?)\s(\d{2}.\d{2})\s(\d+)\s(\d{2,}.?\d{2})/", $texto, $productos);
    $datos['productos'] = [];
    for ($i = 0; $i < count($productos[0]); $i++) {
        $datos['productos'][] = [
            'codigo' => $productos[1][$i],
            'nombre' => $productos[2][$i],
            'precio_unitario' => $productos[3][$i],
            'cantidad' => $productos[4][$i],
            'importe' => $productos[5][$i],
        ];
    }

    // Extraer resumen de la factura
    preg_match("/SUBTOTAL\s([\d,]+.\d{2})\sIVA\s([\d,]+.\d{2})\sTOTAL\s([\d,]+.\d{2})/", $texto, $resumen);
    $datos['subtotal'] = isset($resumen[1]) ? $resumen[1] : '';
    $datos['iva'] = isset($resumen[2]) ? $resumen[2] : '';
    $datos['total'] = isset($resumen[3]) ? $resumen[3] : '';

    return $datos;
}

// Función para mostrar los datos en formato HTML
function mostrar_datos_factura($datos) {
    echo "<h2>Factura</h2>";
    echo "<p><strong>Cliente:</strong> {$datos['cliente_id']} - {$datos['cliente_nombre']}</p>";
    echo "<p><strong>Dirección del cliente:</strong> {$datos['cliente_direccion']}</p>";
    echo "<table border='1'>
            <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Importe</th>
            </tr>";
    foreach ($datos['productos'] as $producto) {
        echo "<tr>
                <td>{$producto['codigo']}</td>
                <td>{$producto['nombre']}</td>
                <td>{$producto['precio_unitario']}</td>
                <td>{$producto['cantidad']}</td>
                <td>{$producto['importe']}</td>
              </tr>";
    }
    echo "</table>";
    echo "<p><strong>Subtotal:</strong> {$datos['subtotal']}</p>";
    echo "<p><strong>IVA:</strong> {$datos['iva']}</p>";
    echo "<p><strong>Total:</strong> {$datos['total']}</p>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
    $nombreArchivo = $_FILES['archivo']['name'];
    $rutaArchivo = __DIR__ . '/../uploads/' . $nombreArchivo;

    // Mover el archivo subido a la carpeta 'uploads'
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
        // Procesar la imagen para extraer texto mediante OCR
        $textoFactura = obtenerTextoDeOCR($rutaArchivo);

        // Procesar el texto de la factura extraído por el OCR
        $datosFactura = extraer_datos($textoFactura);

        // Mostrar los datos extraídos en formato HTML
        mostrar_datos_factura($datosFactura);
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
