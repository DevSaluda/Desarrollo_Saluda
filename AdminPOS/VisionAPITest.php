<?php
require 'vendor/autoload.php';
include 'Consultas/Consultas.php';

use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\InputConfig;

function extraerTextoDePDF($rutaArchivoPDF) {
    putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/../app-saluda-966447541c3c.json');

    $imageAnnotator = new ImageAnnotatorClient();

    try {
        $contenidoArchivo = file_get_contents($rutaArchivoPDF);

        $inputConfig = new InputConfig();
        $inputConfig->setContent($contenidoArchivo);
        $inputConfig->setMimeType('application/pdf');

        $request = new \Google\Cloud\Vision\V1\AnnotateFileRequest();
        $request->setInputConfig($inputConfig);

        $feature = new Feature();
        $feature->setType(Feature\Type::DOCUMENT_TEXT_DETECTION);
        $request->setFeatures([$feature]);

        $requests = [$request];
        $response = $imageAnnotator->batchAnnotateFiles($requests);

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
        $imageAnnotator->close();
    }
}

function buscarProductosEnBD($conn, $textoEscaneado) {
    // Convertir el texto escaneado en palabras clave
    $palabras = explode(' ', $textoEscaneado);
    
    // Limpiar las palabras clave (evitar inyecciones y palabras vacías)
    $palabrasFiltradas = array_filter($palabras, function($palabra) {
        return !empty($palabra);
    });

    if (count($palabrasFiltradas) === 0) {
        return false; // Si no hay palabras, no hacer búsqueda
    }

    // Buscar productos que coincidan completamente con alguna de las palabras clave
    $sql = "SELECT * FROM Productos_POS WHERE ";
    $sql .= implode(" OR ", array_map(function($palabra) use ($conn) {
        $palabra = mysqli_real_escape_string($conn, $palabra); // Escapar posibles inyecciones SQL
        return "Nombre_Prod LIKE '%$palabra%'"; // Coincidencia parcial con las palabras
    }, $palabrasFiltradas));

    $resultados = mysqli_query($conn, $sql);

    return $resultados;
}

// Subir archivo PDF y extraer el texto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
    $nombreArchivo = $_FILES['archivo']['name'];
    $rutaArchivo = __DIR__ . '/../uploads/' . $nombreArchivo;

    // Mover el archivo a la carpeta 'uploads'
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
        // Extraer texto del PDF
        $textoExtraido = extraerTextoDePDF($rutaArchivo);

        echo "<h2>Texto Extraído del PDF:</h2>";
        echo "<pre>" . htmlspecialchars($textoExtraido) . "</pre>";

        // Buscar productos en la base de datos que coincidan con el texto extraído
        $productosEncontrados = buscarProductosEnBD($conn, $textoExtraido);

        if ($productosEncontrados && mysqli_num_rows($productosEncontrados) > 0) {
            echo "<h2>Productos Coincidentes:</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Lote</th>
                        <th>Fecha Caducidad</th>
                        <th>Stock</th>
                    </tr>";

            while ($producto = mysqli_fetch_assoc($productosEncontrados)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($producto['ID_Prod_POS']) . "</td>";
                echo "<td>" . htmlspecialchars($producto['Nombre_Prod']) . "</td>";
                echo "<td>" . htmlspecialchars($producto['Precio_Venta']) . "</td>";
                echo "<td>" . htmlspecialchars($producto['Lote_Med']) . "</td>";
                echo "<td>" . htmlspecialchars($producto['Fecha_Caducidad']) . "</td>";
                echo "<td>" . htmlspecialchars($producto['Stock']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No se encontraron productos coincidentes.";
        }

    } else {
        echo "Error al subir el archivo.";
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
