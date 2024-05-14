<?php

include_once 'db_connection.php';

$Nombres_Apellidos = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['NombresExt']))));
$Telefono = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['TelExt']))));
$Fk_sucursal = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));
$Fecha = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Fecha']))));
$Hora = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Hora']))));
$LabAgendado = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['LabAgendado']))));
$Agrego = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Agendo']))));

// Insertar datos del formulario en la base de datos
$sql = "SELECT Nombres_Apellidos, Fecha FROM Agenda_Labs WHERE Nombres_Apellidos='$Nombres_Apellidos' AND Fecha='$Fecha'";
$resultset = mysqli_query($conn, $sql) or die("error de la base de datos: " . mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);

// Verificar si hay resultados antes de acceder al índice del array
if ($row && $row['Nombres_Apellidos'] == $Nombres_Apellidos && $row['Fecha'] == "$Fecha"  && $row['LabAgendado'] == "$LabAgendado" && $row['Hora'] == "$Hora") {
    echo json_encode(array("statusCode" => 250));
} else {
    $sql = "INSERT INTO `Agenda_Labs`(`Nombres_Apellidos`, `Telefono`, `Fk_sucursal`,`Fecha``LabAgendado`,`Hora`,`Agrego`) 
    VALUES ('$Nombres_Apellidos','$Telefono','$Fk_sucursal','$Fecha','$LabAgendado','$Hora','$Agrego')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }

    // Cerrar la conexión después de usarla
    mysqli_close($conn);
}
?>
