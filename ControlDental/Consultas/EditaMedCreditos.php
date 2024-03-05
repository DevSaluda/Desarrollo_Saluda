<?php
include "db_connection.php";

        $ID_Med_Cred=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id_ActMed']))));
     
       $Nombre_Med=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActAreaMed']))));
        $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaEstActMed']))));
        $CodigoEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActVigenciaMedico']))));
        $Agrega=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioActMed']))));
      
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaActMed']))));
        $sql = "UPDATE `Medicos_Credit_POS` 
        SET `Nombre_Med`='$Nombre_Med',
       
        `Estatus`='$Estatus',
        `CodigoEstatus`='$CodigoEstatus',
        `Agrega`='$Agrega',
        `Sistema`='$Sistema'
WHERE ID_Med_Cred=$ID_Med_Cred";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
