<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del OCR</title>
</head>
<body>
    <h2>Resultado del Texto Reconocido</h2>

    <?php
    // Verificar si el parámetro 'texto' está en la URL
    if (isset($_GET['texto'])) {
        // Decodificar el texto de la URL
        $textoReconocido = urldecode($_GET['texto']);
        echo "<p><strong>Texto reconocido:</strong> $textoReconocido</p>";
    } else {
        echo "<p>No se recibió ningún texto procesado.</p>";
    }
    ?>

    <a href="index.html">Volver a la página principal</a>
</body>
</html>
