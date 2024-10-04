<?php
require 'vendor/autoload.php';

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

function extraerBloquesDeImagen($rutaImagen) {
    putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/../app-saluda-966447541c3c.json'); // Ajusta a la ruta de tus credenciales
    $imageAnnotator = new ImageAnnotatorClient();

    try {
        $image = file_get_contents($rutaImagen);
        $response = $imageAnnotator->documentTextDetection($image);
        $fullTextAnnotation = $response->getFullTextAnnotation();

        if (!$fullTextAnnotation) {
            return 'No se detectó texto en la imagen.';
        }

        $bloques = [];

        // Recorrer las páginas y luego los bloques de cada página
        foreach ($fullTextAnnotation->getPages() as $page) {
            foreach ($page->getBlocks() as $block) {
                $bloqueTexto = '';

                // Recorrer los párrafos dentro de cada bloque
                foreach ($block->getParagraphs() as $paragraph) {
                    $paragraphText = '';

                    // Recorrer las palabras dentro de cada párrafo
                    foreach ($paragraph->getWords() as $word) {
                        $symbols = $word->getSymbols();
                        foreach ($symbols as $symbol) {
                            $paragraphText .= $symbol->getText();
                        }
                        $paragraphText .= ' ';  // Agregar espacio entre palabras
                    }

                    $bloqueTexto .= trim($paragraphText) . "\n";  // Agregar un salto de línea entre párrafos
                }

                $bloques[] = trim($bloqueTexto);  // Guardar cada bloque de texto limpio
            }
        }

        return $bloques;

    } finally {
        $imageAnnotator->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
    $nombreArchivo = $_FILES['archivo']['name'];
    $rutaArchivo = __DIR__ . '/../uploads/' . $nombreArchivo;

    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
        // Extraer los bloques de texto
        $bloquesDeTexto = extraerBloquesDeImagen($rutaArchivo);

        // Mostrar los bloques de texto
        echo "<h2>Bloques de Texto Detectados:</h2>";
        foreach ($bloquesDeTexto as $indice => $bloque) {
            echo "<h3>Bloque $indice:</h3>";
            echo "<pre>" . htmlspecialchars($bloque) . "</pre>";
        }
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
