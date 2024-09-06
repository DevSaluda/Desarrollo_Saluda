<?php
header('Content-Type: application/json');
include("db_connection.php");

// Verifica si se ha enviado el dato por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si la variable 'id' está seteada
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Escapa los datos para evitar inyección SQL
        $id = mysqli_real_escape_string($conn, $id);

        // Construye la consulta SQL para eliminar la fila
        $sql = "DELETE FROM Sugerencias_POS WHERE Id_Sugerencia = '$id'";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["error" => "Error al eliminar: " . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["error" => "No se recibió el ID."]);
    }
} else {
    echo json_encode(["error" => "Método de solicitud no válido."]);
}

mysqli_close($conn);
?>
