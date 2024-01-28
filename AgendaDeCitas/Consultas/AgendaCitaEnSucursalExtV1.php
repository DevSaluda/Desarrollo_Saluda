<?php

include_once 'db_connection.php';

$Cita = "Agendado";
$ColorClaveCalendario = "#04B45F";

$Fk_Especialidad = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['EspecialidadExt']))));
$Fk_Especialista = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['MedicoExt']))));
$Fk_Sucursal = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalExt']))));
$Fecha = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaExt']))));
$Hora = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['HorasExt']))));
$Costo = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['CostoExt']))));
$Nombre_Paciente = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['NombresExt']))));
$Telefono = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['TelExt']))));
$Tipo_Consulta = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['TipoConsultaExt']))));
$Estatus_cita = $conn->real_escape_string(htmlentities(strip_tags(Trim($Cita))));
$Observaciones = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['ObservacionesExt']))));
$ID_H_O_D = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaExt']))));
$AgendadoPor = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioExt']))));
$Sistema = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaExt']))));
$Color_Calendario = $conn->real_escape_string(htmlentities(strip_tags(Trim($ColorClaveCalendario))));

$sql = "SELECT Fk_Especialidad,Fk_Especialista,Fk_Sucursal,Fecha,Hora,Nombre_Paciente,Telefono,Tipo_Consulta,ID_H_O_D  
        FROM AgendaCitas_EspecialistasExt 
        WHERE Fk_Especialidad='$Fk_Especialidad' 
        AND Fk_Especialista='$Fk_Especialista' 
        AND Fk_Sucursal='$Fk_Sucursal' 
        AND Fecha='$Fecha' 
        AND Hora='$Hora' 
        AND Nombre_Paciente='$Nombre_Paciente' 
        AND Telefono='$Telefono' 
        AND Tipo_Consulta='$Tipo_Consulta' 
        AND ID_H_O_D='$ID_H_O_D' ";

$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);

if ($row !== null) {
    $Fk_Fecha = isset($row['Fecha']) ? $row['Fecha'] : null;
    $Fk_Hora = isset($row['Hora']) ? $row['Hora'] : null;

    if (
        $row['Nombre_Paciente'] == $Nombre_Paciente &&
        $Fk_Fecha == $Fecha &&
        $Fk_Hora == $Hora &&
        $row['Fk_Especialidad'] == $Fk_Especialidad
    ) {
        echo json_encode(array("statusCode" => 250));
    } else {
        $sql = "INSERT INTO `AgendaCitas_EspecialistasExt`(`Fk_Especialidad`, `Fk_Especialista`, `Fk_Sucursal`, `Fecha`, `Hora`, `Costo`, 
                `Nombre_Paciente`, `Telefono`, `Tipo_Consulta`, `Estatus_cita`, `Observaciones`, `ID_H_O_D`, `AgendadoPor`, `Sistema`,  `Color_Calendario`) 
                VALUES ('$Fk_Especialidad','$Fk_Especialista', '$Fk_Sucursal','$Fecha','$Hora','$Costo', 
                '$Nombre_Paciente','$Telefono','$Tipo_Consulta', '$Estatus_cita', '$Observaciones','$ID_H_O_D','$AgendadoPor','$Sistema', '$Color_Calendario')";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo json_encode(array("statusCode" => 201));
        }
    }
} else {
    echo json_encode(array("statusCode" => 500, "error" => "No se encontraron datos en la base de datos"));
}

mysqli_close($conn);

?>
