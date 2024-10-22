<?php
include_once 'db_connection.php';

// Asegúrate de que la respuesta sea en formato JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $sucursal = $_POST['sucursal'];
    $tutorial = $_POST['tutorial'];

    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($sucursal)) {
        $sql = "INSERT INTO tutoriales_vistos (nombre, sucursal, tutorial, fecha_visto) VALUES ('$nombre', '$sucursal', '$tutorial', NOW())";
        
        // Verifica si se ejecuta correctamente
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error en la consulta']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Campos vacíos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
