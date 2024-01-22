<?php

include_once 'db_connection.php';
    
$Fk_Especialidad =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['especialidad']))));
$Fk_Especialista	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['medico']))));
$Fk_Sucursal =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['sucursal']))));
$Fk_Fecha= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['fecha']))));	
$Fk_Hora	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['hora']))));
$Fk_Costo= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['costo']))));	
$Nombre_Paciente= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['nombrep']))));
$Telefono	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['telefono']))));	
$Tipo_Consulta	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['tipoconsulta']))));
$Estatus_pago= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['estatuspago']))));	
$Color_Pago	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['colorpago']))));
$Estatus_cita= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['estatuscita']))));	
$Observaciones	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['observaciones']))));
$ColorEstatusCita =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['colorcita']))));
$Estatus_Seguimiento   =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['estatussegui']))));
$Color_Seguimiento	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['colorsegui']))));
$ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['empresa']))));
$AgendadoPor =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['agenda']))));
$Sistema =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['sistema']))));
    //include database configuration file
    
    //insert form data in the database
    
    
    $sql = "INSERT INTO `AgendaCitas_Especialistas`( `Fk_Especialidad`,`Fk_Especialista`,`Fk_Sucursal`,`Fk_Fecha`,`Fk_Hora`,`Fk_Costo`,
    `Nombre_Paciente`,`Telefono`,`Tipo_Consulta`,`Estatus_pago`,`Color_Pago`,`Estatus_cita`,`Observaciones`,`ColorEstatusCita`,`Estatus_Seguimiento`,
    `Color_Seguimiento`,`ID_H_O_D`,`AgendadoPor`,`Sistema`) 
	VALUES ('$Fk_Especialidad','$Fk_Especialista','$Fk_Sucursal','$Fk_Fecha','$Fk_Hora','$Fk_Costo','$Nombre_Paciente','$Telefono','$Tipo_Consulta','$Estatus_pago','$Color_Pago',
    '$Estatus_cita','$Observaciones','$ColorEstatusCita','$Estatus_Seguimiento','$Color_Seguimiento','$ID_H_O_D','$AgendadoPor','$Sistema')";

    if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
    
?>