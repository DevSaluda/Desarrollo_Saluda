<?php
// Incluye el autoload de Composer para cargar las dependencias
require 'vendor/autoload.php';

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

// Función para limpiar el texto extraído del OCR
function limpiarTextoOCR($texto) {
    $texto = preg_replace('/\s+/', ' ', $texto); // Elimina espacios extra
    $texto = str_replace("\r", "\n", $texto);    // Normaliza saltos de línea
    return trim($texto);
}

// Función para extraer bloques de texto de una imagen usando Google Cloud Vision API
function extraerBloquesDeImagen($rutaImagen) {
    putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/../app-saluda-966447541c3c.json'); // Ruta correcta a las credenciales
    $imageAnnotator = new ImageAnnotatorClient();

    try {
        $image = file_get_contents($rutaImagen);
        $response = $imageAnnotator->documentTextDetection($image);
        $fullTextAnnotation = $response->getFullTextAnnotation();
        if (!$fullTextAnnotation) {
            return 'No se detectó texto en la imagen.';
        }

        // Extraer los bloques de texto
        $pages = $fullTextAnnotation->getPages();
        $bloques = [];

        foreach ($pages as $page) {
            foreach ($page->getBlocks() as $block) {
                $textoBloque = '';
                foreach ($block->getParagraphs() as $paragraph) {
                    foreach ($paragraph->getWords() as $word) {
                        foreach ($word->getSymbols() as $symbol) {
                            $textoBloque .= $symbol->getText();
                        }
                        $textoBloque .= ' '; // Agrega un espacio entre palabras
                    }
                }
                $bloques[] = limpiarTextoOCR($textoBloque); // Limpia y almacena cada bloque
            }
        }

        return $bloques;
    } finally {
        $imageAnnotator->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
    $nombreArchivo = $_FILES['archivo']['name'];
    $rutaArchivo = __DIR__ . '/../uploads/' . $nombreArchivo; // Corrige la ruta aquí

    // Mover el archivo subido a la carpeta 'uploads'
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
        // Procesar la imagen para extraer bloques de texto
        $bloquesExtraidos = extraerBloquesDeImagen($rutaArchivo);

        // Mostrar los bloques extraídos
        echo "<h2>Bloques de Texto Detectados:</h2>";
        echo "<div style='border: 1px solid #000; padding: 10px;'>";
        if (is_array($bloquesExtraidos)) {
            foreach ($bloquesExtraidos as $bloque) {
                echo "<p style='margin-bottom: 10px;'>" . htmlspecialchars($bloque) . "</p>";
            }
        } else {
            echo "<p>" . htmlspecialchars($bloquesExtraidos) . "</p>";
        }
        echo "</div>";
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
    <h1>Subir una imagen para extraer bloques de texto (OCR)</h1>

    <form action="" method="post" enctype="multipart/form-data">
        Selecciona una imagen:
        <input type="file" name="archivo" accept="image/*" required>
        <input type="submit" value="Subir Imagen">
    </form>
</body>
</html>
