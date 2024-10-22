<?php
include_once 'db_connection.php'; // Incluye tu conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $tutorial = $_POST['tutorial'];

    // Asegurarse de que se recibieron los datos
    if (!empty($nombre) && !empty($tutorial)) {
        // Consulta para verificar si el usuario ya ha visto el tutorial
        $sql = "SELECT * FROM tutoriales_vistos WHERE nombre = '$nombre' AND tutorial = '$tutorial'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // El usuario ya ha visto el tutorial
            echo json_encode(['visto' => true]);
        } else {
            // El usuario no ha visto el tutorial
            echo json_encode(['visto' => false]);
        }
    } else {
        // Si los datos están vacíos, retornar un error
        echo json_encode(['visto' => false, 'error' => 'Datos incompletos']);
    }
} else {
    // Si no es una solicitud POST, retornar un error
    echo json_encode(['visto' => false, 'error' => 'Método de solicitud no válido']);
}

mysqli_close($conn);
?>
