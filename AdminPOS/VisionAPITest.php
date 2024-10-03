<?php
require 'vendor/autoload.php'; // Incluye el autoload de Composer para cargar las dependencias

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

// Función para enviar una imagen a Google Cloud Vision API
function analizarImagen($rutaImagen) {
    // Configurar la ruta a las credenciales JSON
    putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/../app-saluda-966447541c3c.json');

    // Crear un cliente para Google Cloud Vision
    $client = new ImageAnnotatorClient();

    // Leer la imagen y convertirla a base64
    $imageData = file_get_contents($rutaImagen);
    $base64 = base64_encode($imageData);

    // Preparar la solicitud
    $response = $client->batchAnnotateImages([
        'requests' => [
            [
                'image' => [
                    'content' => $base64,
                ],
                'features' => [
                    ['type' => 'LANDMARK_DETECTION', 'maxResults' => 50],
                    ['type' => 'FACE_DETECTION', 'maxResults' => 50],
                    ['type' => 'OBJECT_LOCALIZATION', 'maxResults' => 50, 'model' => 'builtin/latest'],
                    ['type' => 'LOGO_DETECTION', 'maxResults' => 50],
                    ['type' => 'LABEL_DETECTION', 'maxResults' => 50],
                    ['type' => 'DOCUMENT_TEXT_DETECTION', 'maxResults' => 50, 'model' => 'builtin/latest'],
                    ['type' => 'SAFE_SEARCH_DETECTION', 'maxResults' => 50],
                    ['type' => 'IMAGE_PROPERTIES', 'maxResults' => 50],
                    ['type' => 'CROP_HINTS', 'maxResults' => 50],
                ],
                'imageContext' => [
                    'cropHintsParams' => [
                        'aspectRatios' => [0.8, 1, 1.2],
                    ],
                ],
            ],
        ],
    ]);

    // Procesar la respuesta
    foreach ($response->getResponses() as $res) {
        if ($res->hasError()) {
            echo 'Error: ' . $res->getError()->getMessage() . "\n";
            continue;
        }

        // Ejemplo de procesamiento de la respuesta
        // Detección de texto
        if ($res->hasFullTextAnnotation()) {
            $text = $res->getFullTextAnnotation()->getText();
            echo "Texto extraído: " . htmlspecialchars($text) . "\n";
        }

        // Detección de rostros
        if ($res->getFaceAnnotations()) {
            echo "Rostros detectados: " . count($res->getFaceAnnotations()) . "\n";
        }

        // Detección de logotipos
        if ($res->getLogoAnnotations()) {
            echo "Logotipos detectados: " . count($res->getLogoAnnotations()) . "\n";
        }

        // Detección de objetos
        if ($res->getLocalizedObjectAnnotations()) {
            echo "Objetos detectados: " . count($res->getLocalizedObjectAnnotations()) . "\n";
        }

        // Otros tipos de análisis pueden ser añadidos de manera similar
        // ...
    }

    $client->close(); // Cerrar el cliente
}

// Probar la función con una imagen
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
    $nombreArchivo = $_FILES['archivo']['name'];
    $rutaArchivo = __DIR__ . '/../uploads/' . $nombreArchivo;

    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
        analizarImagen($rutaArchivo); // Llama a la función para analizar la imagen
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
    <title>Subir Imagen para Análisis</title>
</head>
<body>
    <h1>Subir una imagen para análisis</h1>
    <form action="" method="post" enctype="multipart/form-data">
        Selecciona una imagen:
        <input type="file" name="archivo" accept="image/*" required>
        <input type="submit" value="Subir Imagen">
    </form>
</body>
</html>
