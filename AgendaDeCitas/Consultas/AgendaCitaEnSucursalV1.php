<?php

include_once 'db_connection.php';
$Cita="Agendado";
$ColorClaveCalendario="#04B45F";
$Fk_Especialidad =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Especialidad']))));
$Fk_Especialista	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Medico']))));
$Fk_Sucursal =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));
$Fecha= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Fecha']))));	
$Hora	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Horas']))));
$Costo= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Costo']))));
$Nombre_Paciente= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Nombres']))));
$Telefono= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Tel']))));
$Tipo_Consulta	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TipoConsulta']))));
$Estatus_cita= $conn -> real_escape_string(htmlentities(strip_tags(Trim($Cita))));	
$Observaciones	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Observaciones']))));
$ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));
$AgendadoPor =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));
$Sistema =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
$Color_Calendario	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($ColorClaveCalendario))));

    //include database configuration file
    
    //insert form data in the database
    $sql = "SELECT Fk_Especialidad,Fk_Especialista,Fk_Sucursal,Fecha,Hora,Nombre_Paciente,Telefono,Tipo_Consulta,ID_H_O_D  FROM AgendaCitas_EspecialistasSucursales WHERE 
    Fk_Especialidad='$Fk_Especialidad' AND Fk_Especialista='$Fk_Especialista' AND Fk_Sucursal='$Fk_Sucursal'AND Fecha='$Fecha' AND Hora='$Hora' AND 
    Nombre_Paciente='$Nombre_Paciente' AND Telefono='$Telefono' AND Tipo_Consulta='$Tipo_Consulta'AND ID_H_O_D='$ID_H_O_D' ";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);	
    //include database configuration file
    if($row['Nombre_Paciente']==$Nombre_Paciente  AND $row['Fk_Fecha']=="$Fk_Fecha" AND $row['Fk_Hora']=="$Fk_Hora" AND $row['Fk_Especialidad']=="$Fk_Especialidad"){				
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
    
		$sql = "INSERT INTO `AgendaCitas_EspecialistasSucursales`(`Fk_Especialidad`, `Fk_Especialista`, `Fk_Sucursal`, `Fecha`, `Hora`, `Costo`, 
        `Nombre_Paciente`, `Telefono`, `Tipo_Consulta`, `Estatus_cita`, `Observaciones`, `ID_H_O_D`, `AgendadoPor`, `Sistema`, `Fecha_Hora`, `Color_Calendario`) 
		VALUES ('$Fk_Especialidad','$Fk_Especialista', '$Fk_Sucursal','$Fecha','$Hora','$Costo', 
        '$Nombre_Paciente','$Telefono','$Tipo_Consulta', '$Estatus_cita', '$Observaciones','$ID_H_O_D','$AgendadoPor','$Sistema', '$Fecha_Hora', '$Color_Calendario')";
	
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);
   

    mysqli_close($conn);
}

?>

