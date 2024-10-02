<?php
// Incluye el autoload de Composer para cargar las dependencias
require 'vendor/autoload.php';

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

// Función para extraer texto de una imagen usando Google Cloud Vision API
function extraerTextoDeImagen($rutaImagen) {
    // Configurar la ruta a las credenciales JSON
    putenv('GOOGLE_APPLICATION_CREDENTIALS=/https://saludapos.com/app-saluda-966447541c3c.json');

    // Crear un cliente para Google Cloud Vision
    $imageAnnotator = new ImageAnnotatorClient();

    try {
        // Leer el archivo de la imagen
        $image = file_get_contents($rutaImagen);

        // Enviar la imagen a Google Cloud Vision para realizar OCR
        $response = $imageAnnotator->textDetection($image);
        $texts = $response->getTextAnnotations();

        // Retornar el texto detectado
        if ($texts) {
            return $texts[0]->getDescription();
        } else {
            return 'No se detectó texto en la imagen.';
        }

    } finally {
        $imageAnnotator->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
    $nombreArchivo = $_FILES['archivo']['name'];
    $rutaArchivo = __DIR__ . '/home/u155356178/domains/saludapos.com/public_html/uploads/' . $nombreArchivo; // Asegura que se use la ruta correcta

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
