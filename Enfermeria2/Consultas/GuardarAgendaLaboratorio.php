<?php
include_once 'db_connection.php';

// Limpieza y validación de datos
$Nombres_Apellidos = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Nombres']))));
$Telefono = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Tel']))));
$Fk_sucursal = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Sucursal']))));
$Fecha = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Fecha']))));
$Turno = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Turno']))));
$Laboratorios = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['NombresLab']))));
$Agrego = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Enfermero']))));
$Indicaciones = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Indicaciones']))));
$empresa = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Empresa']))));
$sistema = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['sistema']))));

// Consulta SQL con valores escapados
$sql = "INSERT INTO `Agenda_Labs` (
    `Nombres_Apellidos`,
    `Telefono`,
    `Fk_sucursal`,
    `Turno`,
    `Fecha`,
    `LabAgendado`,
    `Agrego`,
    `Indicaciones`,
    `ID_H_O_D`,
    `Sistema`
) VALUES (
    '$Nombres_Apellidos',
    '$Telefono',
    '$Fk_sucursal',
    '$Turno',
    '$Fecha',
    '$Laboratorios',
    '$Agrego',
    '$Indicaciones',
    '$empresa',
    '$Sistema'
)";

// Intentar ejecutar la consulta
if (mysqli_query($conn, $sql)) {
    // Si tiene éxito, responder con un código de estado 200
    echo json_encode(array("statusCode" => 200));
} else {
    // Si falla, responder con un código de estado 201 y el mensaje de error
    echo json_encode(array("statusCode" => 201, "error" => mysqli_error($conn)));
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>