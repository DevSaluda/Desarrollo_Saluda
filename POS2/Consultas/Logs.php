<?php
include_once 'db_connection.php';

 

    
$Usuario =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['usuario']))));
$Tipo_log =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['log']))));
$Sistema = $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['sistema']))));
$ID_H_O_D = $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['empresa']))));


    
    //include database configuration file
    
    //insert form data in the database
    $sql = "INSERT INTO `Logs_Sistema`( `Usuario`, `Tipo_log`,`Sistema`,`ID_H_O_D`) 
	VALUES ('$Usuario','$Tipo_log','$Sistema','$ID_H_O_D')";

    if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>
