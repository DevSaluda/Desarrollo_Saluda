<?php

include_once 'db_connection.php';

$FK_Medico = $conn -> real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['MedicoExt']))))));
$Fk_Sucursal = $conn -> real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['Sucursal']))))));
$Tipo_Programacion = $conn -> real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['TipoProgramacion']))))));
$Fecha_Inicio = $conn -> real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['FechaApertura']))))));
$Fecha_Fin = $conn -> real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['FechaFin']))))));
$Hora_inicio = $conn -> real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['HoraInicial']))))));
$Hora_Fin = $conn -> real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['HoraFinal']))))));
$Intervalo = $conn -> real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['TimerCitas']))))));
$Estatus = $conn -> real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['Estatus']))))));
$ProgramadoPor = $conn -> real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['Usuario']))))));
$Sistema = $conn -> real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['Sistema']))))));
$ID_H_O_D = $conn -> real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['Empresa']))))));

$sql = "SELECT FK_Medico,Fk_Sucursal,Tipo_Programacion,Fecha_Inicio,Fecha_Fin,Hora_inicio,Hora_Fin,Intervalo,Estatus,ProgramadoPor 
        FROM Programacion_MedicosExt 
        WHERE FK_Medico='$FK_Medico' AND Fk_Sucursal='$Fk_Sucursal' AND Tipo_Programacion='$Tipo_Programacion' 
        AND Fecha_Inicio='$Fecha_Inicio' AND Fecha_Fin='$Fecha_Fin' AND Hora_inicio='$Hora_inicio' 
        AND Hora_Fin='$Hora_Fin' AND Intervalo='$Intervalo' AND Estatus='$Estatus' AND ProgramadoPor='$ProgramadoPor'";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);

// Verificar que $row no sea nulo antes de acceder a sus índices
if ($row && $row['FK_Medico'] == $FK_Medico && $row['Fk_Sucursal'] == $Fk_Sucursal && 
    $row['Tipo_Programacion'] == $Tipo_Programacion && $row['Fecha_Inicio'] == $Fecha_Inicio && 
    $row['Fecha_Fin'] == $Fecha_Fin && $row['Hora_inicio'] == $Hora_inicio && 
    $row['Hora_Fin'] == $Hora_Fin && $row['Intervalo'] == $Intervalo &&
    $row['Estatus'] == $Estatus && $row['ProgramadoPor'] == $ProgramadoPor) {
    
    echo json_encode(array("statusCode" => 250));

} else {
    // Si no existe la programación, se inserta en la base de datos
    $sql = "INSERT INTO `Programacion_MedicosExt`(`FK_Medico`, `Fk_Sucursal`, `Tipo_Programacion`, `Fecha_Inicio`, `Fecha_Fin`, 
            `Hora_inicio`, `Hora_Fin`, `Intervalo`, `Estatus`, `ProgramadoPor`, `Sistema`, `ID_H_O_D`) 
            VALUES ('$FK_Medico', '$Fk_Sucursal', '$Tipo_Programacion', '$Fecha_Inicio', '$Fecha_Fin', '$Hora_inicio', 
            '$Hora_Fin', '$Intervalo', '$Estatus', '$ProgramadoPor', '$Sistema', '$ID_H_O_D')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
}

mysqli_close($conn);

?>
