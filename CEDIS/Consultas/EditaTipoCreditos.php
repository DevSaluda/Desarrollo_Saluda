<?php
include "db_connection.php";

        $ID_Tip_Cred=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
        $Costo=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActCosto']))));
       $Nombre_Tip=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActCrediNom']))));
        $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaEst']))));
        $CodigoEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Vigencia']))));
        $Agrega=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));
      
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
        $sql = "UPDATE `Tipos_Credit_POS` 
        SET `Nombre_Tip`='$Nombre_Tip',
        `Costo`='$Costo',
        `Estatus`='$Estatus',
        `CodigoEstatus`='$CodigoEstatus',
        `Agrega`='$Agrega',
        `Sistema`='$Sistema'
WHERE ID_Tip_Cred=$ID_Tip_Cred";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
