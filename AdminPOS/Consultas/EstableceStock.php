<?php
include "db_connection.php";
// Obtener datos del POST
$tipoAjuste = $_POST['tipoAjuste'];
$fkSucursal = $_POST['fkSucursal'];

// Aquí puedes agregar la lógica para actualizar el stock en la base de datos
// Este es un ejemplo básico, ajusta la consulta según tus necesidades
$sql = "UPDATE Stock_POS SET Existencias_R = 0 WHERE Fk_sucursal = '$fkSucursal'";

$response = array();

if ($conn->query($sql) === TRUE) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();

// Enviar respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>