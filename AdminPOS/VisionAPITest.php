<?php
require 'vendor/autoload.php'; // Incluye el autoload de Composer para cargar las dependencias

use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\Image;
use Google\Cloud\Vision\V1\ImageContext;
use Google\Cloud\Vision\V1\CropHintsParams;

// Función para enviar una imagen a Google Cloud Vision API
function analizarImagen($rutaImagen) {
    // Configurar la ruta a las credenciales JSON
    putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/../app-saluda-966447541c3c.json');

    // Crear un cliente para Google Cloud Vision
    $client = new ImageAnnotatorClient();

    // Leer la imagen y convertirla a base64
    $imageData = file_get_contents($rutaImagen);
    $base64 = base64_encode($imageData);

    // Comprobar si la conversión fue exitosa
    if ($base64 === false) {
        echo "Error al convertir la imagen a base64.\n";
        exit;
    } else {
        echo "Datos de la imagen en base64 generados correctamente. Longitud: " . strlen($base64) . " caracteres.\n";
    }

    // Preparar la imagen
    $image = (new Image())->setContent($base64);

    // Preparar las características de la imagen
    $features = [
        (new Feature())->setType(Feature\Type::DOCUMENT_TEXT_DETECTION)->setMaxResults(50),
    ];

    // Crear la solicitud
    $request = (new AnnotateImageRequest())
        ->setImage($image)
        ->setFeatures($features);

    // Realizar la solicitud de análisis
    $response = $client->batchAnnotateImages([$request]);

    // Procesar la respuesta
    foreach ($response->getResponses() as $res) {
        if ($res->hasError()) {
            echo 'Error: ' . $res->getError()->getMessage() . "\n";
            continue;
        }

        // Obtener los bloques de texto y su posición
        if ($res->hasFullTextAnnotation()) {
            $annotation = $res->getFullTextAnnotation();
            echo "Texto extraído completo:\n" . htmlspecialchars($annotation->getText()) . "\n\n";

            // Recorrer las páginas
            foreach ($annotation->getPages() as $page) {
                // Recorrer los bloques
                foreach ($page->getBlocks() as $block) {
                    echo "Bloque de texto detectado:\n";

                    // Obtener las coordenadas del bloque
                    $vertices = $block->getBoundingBox()->getVertices();
                    foreach ($vertices as $vertex) {
                        echo "Posición del vértice: (" . $vertex->getX() . ", " . $vertex->getY() . ")\n";
                    }

                    // Imprimir el texto del bloque
                    foreach ($block->getParagraphs() as $paragraph) {
                        foreach ($paragraph->getWords() as $word) {
                            $wordText = '';
                            foreach ($word->getSymbols() as $symbol) {
                                $wordText .= $symbol->getText();
                            }
                            echo $wordText . ' '; // Imprimir palabra
                        }
                        echo "\n"; // Salto de línea después de cada párrafo
                    }
                    echo "\n"; // Salto de línea después de cada bloque
                }
            }
        }
    }

    $client->close(); // Cerrar el cliente
}

// Probar la función con una imagen
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
    $nombreArchivo = $_FILES['archivo']['name'];
    $rutaArchivo = __DIR__ . '/../uploads/' . $nombreArchivo;

    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
        // Verificar que el archivo se haya subido
        echo "Archivo subido correctamente: " . $rutaArchivo . "\n";
    
        // Comprobar si el archivo se puede leer
        if (file_exists($rutaArchivo)) {
            $imageData = file_get_contents($rutaArchivo);
            if ($imageData === false) {
                echo "Error al leer el archivo de imagen.\n";
                exit;
            } else {
                echo "El archivo se leyó correctamente. Tamaño: " . strlen($imageData) . " bytes.\n";
            }
        }
    
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
