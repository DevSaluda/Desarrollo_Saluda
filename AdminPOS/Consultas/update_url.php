<?php
header('Content-Type: application/json');
include("db_connection.php");

// Lista de columnas permitidas para actualizar
$editableColumns = ['Cantidad', 'FkPresentacion', 'Proveedor1', 'Proveedor2', 'Nombre_Prod'];

// Verifica si se ha enviado el dato por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si las variables necesarias están seteadas
    if (isset($_POST['id']) && isset($_POST['column']) && isset($_POST['value'])) {
        $id = $_POST['id'];
        $column = $_POST['column'];
        $value = $_POST['value'];

        // Verifica si la columna está en la lista de columnas permitidas
        if (in_array($column, $editableColumns)) {
            // Escapa los datos para evitar inyección SQL
            $id = mysqli_real_escape_string($conn, $id);
            $column = mysqli_real_escape_string($conn, $column);
            $value = mysqli_real_escape_string($conn, $value);

            // Construye la consulta SQL para actualizar la base de datos
            $sql = "UPDATE Sugerencias_POS SET `$column` = '$value' WHERE Id_Sugerencia = '$id'";

            if (mysqli_query($conn, $sql)) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["error" => "Error al actualizar: " . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(["error" => "Columna no permitida para actualización."]);
        }
    } else {
        echo json_encode(["error" => "Datos no proporcionados."]);
    }
} else {
    echo json_encode(["error" => "Método de solicitud no válido."]);
}

mysqli_close($conn);
?>
