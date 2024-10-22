<?php
include_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $sucursal = $_POST['sucursal'];
    $tutorial = $_POST['tutorial'];

    // Validar que no estén vacíos
    if (!empty($nombre) && !empty($sucursal)) {
        $sql = "INSERT INTO tutoriales_vistos (nombre, sucursal, tutorial, fecha_visto) VALUES ('$nombre', '$sucursal', '$tutorial', NOW())";
        
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
