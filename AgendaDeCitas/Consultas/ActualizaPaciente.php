<?php
include "db_connection.php";

        $ID_Data_Paciente=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
       $Nombre_Paciente=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActNombres']))));
        $Fecha_Nacimiento=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Fecha']))));
        $Edad=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Edad']))));
        $Telefono=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActTel']))));
        $Correo=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActCorreo']))));
        $Ingreso=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
        $sql = "UPDATE `Data_Pacientes` 
        SET `Nombre_Paciente`='$Nombre_Paciente',
        `Fecha_Nacimiento`='$Fecha_Nacimiento',
        `Edad`='$Edad',
        `Telefono`='$Telefono',
        `Correo`='$Correo',
        `Ingreso`='$Ingreso',
        `Sistema`='$Sistema'
WHERE ID_Data_Paciente=$ID_Data_Paciente";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
