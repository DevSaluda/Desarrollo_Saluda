<?php
include_once 'db_connection.php';

$Nombres_Apellidos = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['NombresExt']))));
$Telefono = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['TelExt']))));
$Fk_sucursal = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));
$Medico = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Medico']))));
$Fecha = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Fecha']))));
$Turno = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Turno']))));
$Motivo_Consulta = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['MotConsulta']))));
$Agrego = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Agendo']))));

// Realizar la consulta
$sql = "SELECT Nombres_Apellidos,Fecha FROM Agenda_revaloraciones WHERE Nombres_Apellidos='$Nombres_Apellidos' AND Fecha='$Fecha'";
$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));

// Obtener la fila de resultados
$row = mysqli_fetch_assoc($resultset);

// Verificar si la fila no es nula y los valores coinciden
if ($row !== null && $row['Nombres_Apellidos'] == $Nombres_Apellidos && $row['Fecha'] == $Fecha) {
    echo json_encode(array("statusCode" => 250));
} else {
    // Realizar la inserción
    $sql = "INSERT INTO `Agenda_revaloraciones`(`Nombres_Apellidos`, `Telefono`, `Fk_sucursal`, `Medico`, `Fecha`, `Turno`, `Motivo_Consulta`, `Agrego`) 
            VALUES ('$Nombres_Apellidos','$Telefono','$Fk_sucursal','$Medico','$Fecha','$Turno','$Motivo_Consulta','$Agrego')";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    
    mysqli_close($conn);
}
?>
