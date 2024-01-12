<?php
include "db_connection.php";


        $Medico_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
        $Nombre_Apellidos=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActNombres']))));
        $Telefono=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActTel']))));
        $Correo_Electronico=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActCorreo']))));

        
  

        $sql = "UPDATE `Personal_Medico_Express` 
        SET `Nombre_Apellidos`='$Nombre_Apellidos',
        `Correo_Electronico`='$Correo_Electronico',
        `Telefono`='$Telefono'
        WHERE Medico_ID=$Medico_ID";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
