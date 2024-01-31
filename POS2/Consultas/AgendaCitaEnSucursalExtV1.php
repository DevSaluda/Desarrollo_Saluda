<?php

include_once 'db_connection.php';
$Cita="Agendado";
$ColorClaveCalendario="#04B45F";
$Fk_Especialidad =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EspecialidadExt']))));
$Fk_Especialista	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MedicoExt']))));
$Fk_Sucursal =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalExt']))));
$Fecha= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaExt']))));	
$Hora	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['HorasExt']))));
$Nombre_Paciente= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombresExt']))));
$Telefono= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TelExt']))));
$Tipo_Consulta	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TipoConsultaExt']))));
$Estatus_cita= $conn -> real_escape_string(htmlentities(strip_tags(Trim($Cita))));	
$Observaciones	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ObservacionesExt']))));
$ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaExt']))));
$AgendadoPor =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioExt']))));
$Sistema =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaExt']))));
$Color_Calendario	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($ColorClaveCalendario))));

    //include database configuration file
    
    //insert form data in the database
    $sql = "SELECT Fk_Especialidad,Fk_Especialista,Fk_Sucursal,Fecha,Hora,Nombre_Paciente,Telefono,Tipo_Consulta,ID_H_O_D  FROM AgendaCitas_EspecialistasExt WHERE 
    Fk_Especialidad='$Fk_Especialidad' AND Fk_Especialista='$Fk_Especialista' AND Fk_Sucursal='$Fk_Sucursal'AND Fecha='$Fecha' AND Hora='$Hora' AND 
    Nombre_Paciente='$Nombre_Paciente' AND Telefono='$Telefono' AND Tipo_Consulta='$Tipo_Consulta'AND ID_H_O_D='$ID_H_O_D' ";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);	
    //include database configuration file
    if($row['Nombre_Paciente']==$Nombre_Paciente  AND $row['Fk_Fecha']=="$Fk_Fecha" AND $row['Fk_Hora']=="$Fk_Hora" AND $row['Fk_Especialidad']=="$Fk_Especialidad"){				
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
    
		$sql = "INSERT INTO `AgendaCitas_EspecialistasExt`(`Fk_Especialidad`, `Fk_Especialista`, `Fk_Sucursal`, `Fecha`, `Hora`,
        `Nombre_Paciente`, `Telefono`, `Tipo_Consulta`, `Estatus_cita`, `Observaciones`, `ID_H_O_D`, `AgendadoPor`, `Sistema`,  `Color_Calendario`) 
		VALUES ('$Fk_Especialidad','$Fk_Especialista', '$Fk_Sucursal','$Fecha','$Hora',
        '$Nombre_Paciente','$Telefono','$Tipo_Consulta', '$Estatus_cita', '$Observaciones','$ID_H_O_D','$AgendadoPor','$Sistema','$Color_Calendario')";
	
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}

   

    mysqli_close($conn);
}

?>

