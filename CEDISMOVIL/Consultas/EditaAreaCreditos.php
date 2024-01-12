<?php
include "db_connection.php";

        $ID_Area_Cred=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id_ActArea']))));
     
       $Nombre_Area=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActAreaN']))));
        $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaEstActArea']))));
        $CodigoEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActVigenciaArea']))));
        $Agrega=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioActArea']))));
      
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaActArea']))));
        $sql = "UPDATE `Areas_Credit_POS` 
        SET `Nombre_Area`='$Nombre_Area',
       
        `Estatus`='$Estatus',
        `CodigoEstatus`='$CodigoEstatus',
        `Agrega`='$Agrega',
        `Sistema`='$Sistema'
WHERE ID_Area_Cred=$ID_Area_Cred";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
