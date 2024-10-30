<?php
// Incluir el archivo de conexión
include "db_connection.php"; // Asegúrate de que esta ruta sea correcta

// Recibir los datos del POST (desde el AJAX)
$data = json_decode(file_get_contents("php://input"), true);

// Verificar que los datos necesarios existen
if (!isset($data['ImpresoPor']) || !isset($data['fkSucursal'])) {
    echo json_encode(["error" => "Datos incompletos"]);
    exit();
}

// Preparar la consulta de inserción
$sql = "INSERT INTO `Aperturas_Cajon` (`fecha`, `ImpresoPor`, `fkSucursal`)
        VALUES (NOW(), ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    // Asignar los valores a los marcadores
    mysqli_stmt_bind_param($stmt, 'ss', $data['ImpresoPor'], $data['fkSucursal']);
    
    // Ejecutar la consulta
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => "Registro insertado con éxito", "idRegistro" => mysqli_insert_id($conn)]);
    } else {
        echo json_encode(["error" => "Error al insertar el registro"]);
    }

    // Cerrar el statement
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(["error" => "Error en la preparación de la consulta"]);
}

// Cerrar la conexión
mysqli_close($conn);
?>
