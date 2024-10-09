<?php
require 'vendor/autoload.php';

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

function extraerBloquesDeImagen($rutaArchivo) {
    putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/../app-saluda-966447541c3c.json'); // Ajusta a la ruta de tus credenciales
    $imageAnnotator = new ImageAnnotatorClient();

    try {
        $image = file_get_contents($rutaArchivo);
        $response = $imageAnnotator->documentTextDetection($image);
        $fullTextAnnotation = $response->getFullTextAnnotation();

        if (!$fullTextAnnotation) {
            return 'No se detectó texto en la imagen o PDF.';
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

function pdfToImages($rutaPDF) {
    $imagick = new Imagick();
    $imagick->readImage($rutaPDF);
    $pages = [];

    foreach ($imagick as $page) {
        $page->setImageFormat('png');
        $pages[] = $page->getImageBlob();
    }

    return $pages;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
    $nombreArchivo = $_FILES['archivo']['name'];
    $rutaArchivo = __DIR__ . '/../uploads/' . $nombreArchivo;
    $extensionArchivo = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
        // Si es un archivo PDF, convertir las páginas a imágenes
        if ($extensionArchivo === 'pdf') {
            $imagenes = pdfToImages($rutaArchivo);
            $bloquesDeTexto = [];

            foreach ($imagenes as $imagen) {
                // Guardar la imagen en un archivo temporal
                $rutaImagenTemporal = tempnam(sys_get_temp_dir(), 'img_') . '.png';
                file_put_contents($rutaImagenTemporal, $imagen);

                // Extraer texto de cada imagen generada del PDF
                $bloquesDeTexto[] = extraerBloquesDeImagen($rutaImagenTemporal);

                // Eliminar archivo temporal
                unlink($rutaImagenTemporal);
            }

        } else {
            // Procesar imagen directamente
            $bloquesDeTexto = extraerBloquesDeImagen($rutaArchivo);
        }

        // Mostrar los bloques de texto
        echo "<h2>Bloques de Texto Detectados:</h2>";
        foreach ($bloquesDeTexto as $indice => $bloque) {
            echo "<h3>Bloque $indice:</h3>";
            echo "<pre>" . htmlspecialchars($bloque) . "</pre>";
        }
    } else {
        echo "Hubo un error al subir el archivo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen o PDF para OCR</title>
</head>
<body>
    <h1>Subir una imagen o PDF para extraer bloques de texto (OCR)</h1>

    <form action="" method="post" enctype="multipart/form-data">
        Selecciona una imagen o PDF:
        <input type="file" name="archivo" accept="image/*,application/pdf" required>
        <input type="submit" value="Subir Archivo">
    </form>
</body>
</html>
