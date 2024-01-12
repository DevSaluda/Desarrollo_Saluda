<?php

include_once 'db_connection.php';
$ClaveEstatus='En espera';
$ClaveColor="background-color: #ffbb33 !important;";
$Folio_Paciente =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['folio']))));
$Nombre_Paciente =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['nombres']))));
$Edad =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['edad']))));
$Sexo =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['sexo']))));
$Telefono =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['tel']))));
$Correo =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['correo']))));
$Peso =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['txtPeso']))));
$Talla =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['txtTalla']))));
$IMC =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['imc']))));
$Estatus_IMC =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['estado']))));
$Temp =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['temperatura']))));
$FC =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['fc']))));
$FR =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['fr']))));
$TA =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ta']))));
$TA2 =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ta2']))));
$Sa02 =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['sa02']))));
$DxTx =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['dxtx']))));
$Motivo_Consulta =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['motivo']))));
$Estatus =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($ClaveEstatus))));
$CodigoEstatus =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($ClaveColor))));
$Nombre_Doctor =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['doctor']))));
$Estatus =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($ClaveEstatus))));
$CodigoEstatus =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($ClaveColor))));
$Estado =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['estador']))));
$Municipio =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['municipior']))));
$Localidad =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['localidadr']))));
$Alergias =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['alergias']))));
$Fk_Sucursal =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['sucursal']))));
$ID_TURNO =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['turno']))));
$Enterado =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['tipov']))));
$Visita =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['visita']))));
$Fk_Enfermero =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['user']))));
$FK_ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['empresa']))));

    
    //insert form data in the database
    
    
    $sql = "INSERT INTO `Signos_VitalesV2`( `Folio_Paciente`,`Nombre_Paciente`,`Edad`,`Sexo`,`Telefono`,`Correo`,`Peso`,`Talla`,`IMC`,`Estatus_IMC`,`Temp`,`FC`,`FR`,`TA`,`TA2`,`Sa02`,`DxTx`,
    `Motivo_Consulta`,`Nombre_Doctor`,`Estatus`,`CodigoEstatus`,`Estado`,`Municipio`,`Localidad`,`Alergias`,`Fk_Sucursal`,`ID_TURNO`,`Enterado`,`Visita`,`Fk_Enfermero`,`FK_ID_H_O_D`) 
	VALUES ('$Folio_Paciente','$Nombre_Paciente','$Edad','$Sexo','$Telefono','$Correo','$Peso','$Talla','$IMC','$Estatus_IMC','$Temp','$FC','$FR','$TA','$TA2','$Sa02','$DxTx',
    '$Motivo_Consulta','$Nombre_Doctor','$Estatus','$CodigoEstatus','$Estado','$Municipio','$Localidad','$Alergias','$Fk_Sucursal','$ID_TURNO','$Enterado','$Visita','$Fk_Enfermero','$FK_ID_H_O_D')";

    if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
    
?>