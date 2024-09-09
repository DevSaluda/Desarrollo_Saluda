<?php
include 'Consultas.php';

if (isset($_POST['update_pdf_path']) && isset($_POST['IdentificadorCotizacion']) && isset($_POST['pdfFilePath'])) {
    $identificadorCotizacion = $_POST['IdentificadorCotizacion'];
    $pdfFilePath = $_POST['pdfFilePath'];

    // Preparar la consulta para actualizar el campo ArchivoPDF
    $query = "UPDATE Cotizaciones_POS SET ArchivoPDF = ? WHERE IdentificadorCotizacion = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta']);
        exit();
    }

    $stmt->bind_param('ss', $pdfFilePath, $identificadorCotizacion);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al ejecutar la consulta']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Datos no válidos']);
}
?>
