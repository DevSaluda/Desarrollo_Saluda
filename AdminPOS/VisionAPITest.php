<?php
// Incluye el autoload de Composer para cargar las dependencias
require 'vendor/autoload.php';

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

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

        // Retornar el texto completo detectado
        if ($fullTextAnnotation) {
            return $fullTextAnnotation->getText();
        } else {
            return 'No se detectó texto en la imagen.';
        }

    } finally {
        $imageAnnotator->close();
    }
}

// El resto del código permanece igual
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
    $nombreArchivo = $_FILES['archivo']['name'];
    $rutaArchivo = __DIR__ . '/../uploads/' . $nombreArchivo; // Corrige la ruta aquí

    // Mover el archivo subido a la carpeta 'uploads'
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
        // Procesar la imagen para extraer texto
        $textoExtraido = extraerTextoDeImagen($rutaArchivo);
        echo "<h2>Texto extraído de la imagen:</h2>";
        echo "<pre>" . htmlspecialchars($textoExtraido) . "</pre>";
    } else {
        echo "Hubo un error al subir la imagen.";
    }
}
?>
