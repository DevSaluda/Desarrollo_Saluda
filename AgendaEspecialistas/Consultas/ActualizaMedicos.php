<?php
include "db_connection.php";

        $Medico_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
       $Nombre_Apellidos=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActNombres']))));
       $Password =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActPass']))));
        $Fecha_Nacimiento=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActFecha']))));
        $Correo_Electronico=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActCorreo']))));
        $Telefono=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AcTtelefono']))));
        $Fk_Sucursal=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['sucursalact']))));

        $sql = "UPDATE `Personal_Medico` 
        SET `Nombre_Apellidos`='$Nombre_Apellidos',
        `Password`='$Password',
        `Fecha_Nacimiento`='$Fecha_Nacimiento',
        `Correo_Electronico`='$Correo_Electronico',
        `Telefono`='$Telefono',
        `Fk_Sucursal`='$Fk_Sucursal'
        WHERE Medico_ID=$Medico_ID";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>