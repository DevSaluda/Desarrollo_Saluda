<?php
// Asegúrate de instalar el cliente de Google Cloud Vision mediante Composer
// composer require google/cloud-vision
// composer require google/protobuf

require 'vendor/autoload.php';

use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\InputConfig;

function extraerTextoDePDF($rutaArchivoPDF) {
    // Configurar la ruta a las credenciales JSON de Google Cloud
    putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/../app-saluda-966447541c3c.json'); // Ajusta la ruta

    // Crear el cliente de Google Cloud Vision
    $imageAnnotator = new ImageAnnotatorClient();

    try {
        // Leer el archivo PDF como contenido binario
        $contenidoArchivo = file_get_contents($rutaArchivoPDF);

        // Crear una entrada de configuración para la API
        $inputConfig = new InputConfig();
        // Aquí usamos directamente el contenido binario sin ByteString
        $inputConfig->setContent($contenidoArchivo); // Ajuste aquí
        $inputConfig->setMimeType('application/pdf'); // Establecer el tipo de archivo como PDF

        // Crear una solicitud de anotación de archivo
        $request = new \Google\Cloud\Vision\V1\AnnotateFileRequest();
        $request->setInputConfig($inputConfig);

        // Definir la característica de detección de texto en documentos
        $feature = new Feature();
        $feature->setType(Feature\Type::DOCUMENT_TEXT_DETECTION);
        $request->setFeatures([$feature]);

        // Enviar la solicitud de procesamiento del PDF
        $requests = [$request]; // Lista de solicitudes (se puede procesar más de uno)
        $response = $imageAnnotator->batchAnnotateFiles($requests);

        // Procesar la respuesta y devolver el texto extraído
        $responses = $response->getResponses();
        foreach ($responses as $fileResponse) {
            foreach ($fileResponse->getResponses() as $imageResponse) {
                if ($imageResponse->hasFullTextAnnotation()) {
                    return $imageResponse->getFullTextAnnotation()->getText();
                }
            }
        }

        return 'No se detectó texto en el archivo PDF.';
        
    } catch (Exception $e) {
        return 'Error durante la extracción de texto: ' . $e->getMessage();
    } finally {
        // Cerrar el cliente
        $imageAnnotator->close();
    }
}

// Subir un archivo PDF y extraer su texto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
    $nombreArchivo = $_FILES['archivo']['name'];
    $rutaArchivo = __DIR__ . '/../uploads/' . $nombreArchivo;

    // Mover el archivo subido a la carpeta 'uploads'
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
        // Llamar a la función para extraer texto del PDF
        $textoExtraido = extraerTextoDePDF($rutaArchivo);

        // Mostrar el texto extraído
        echo "<h2>Texto Extraído del PDF:</h2>";
        echo "<pre>" . htmlspecialchars($textoExtraido) . "</pre>";
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
    <title>Subir PDF para OCR</title>
</head>
<body>
    <h1>Subir un archivo PDF para extraer texto (OCR)</h1>
    <form action="" method="post" enctype="multipart/form-data">
        Selecciona un archivo PDF:
        <input type="file" name="archivo" accept="application/pdf" required>
        <input type="submit" value="Subir PDF">
    </form>
</body>
</html>
