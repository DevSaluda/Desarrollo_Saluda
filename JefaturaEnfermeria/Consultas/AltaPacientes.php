<?php

include_once 'db_connection.php';
    
$Nombre_Paciente =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['nombrep']))));
$Fecha_Nacimiento =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['fechaNac']))));
$Edad =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['edad']))));
$Sexo =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['sexo']))));
$Alergias =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['alergias']))));
$Telefono =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['telefono']))));
$Correo =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['correo']))));
$FK_ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['empresa']))));
$Ingreso =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['agenda']))));
$Sistema =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['sistema']))));
    //include database configuration file
    
    //insert form data in the database
    
    
    $sql = "INSERT INTO `Data_Pacientes`( `Nombre_Paciente`,`Fecha_Nacimiento`,`Edad`,`Sexo`,`Alergias`,`Telefono`,`Correo`,`FK_ID_H_O_D`,`Ingreso`,`Sistema`) 
	VALUES ('$Nombre_Paciente','$Fecha_Nacimiento','$Edad','$Sexo','$Alergias','$Telefono','$Correo','$FK_ID_H_O_D','$Ingreso','$Sistema')";

    if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
    
?>