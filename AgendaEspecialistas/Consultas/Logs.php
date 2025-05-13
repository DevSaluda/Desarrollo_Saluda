<?php
include "db_connection.php";
$Conectado=1;
        $PersonalAgenda_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['usuario']))));
        $Estado_Conexion=$conn -> real_escape_string(htmlentities(strip_tags(Trim($Conectado))));
        $Fecha_ingreso=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['fechaingreso']))));
        $Hora_Ingreso=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Horaingreso']))));
       
       
        $sql = "UPDATE `Personal_Agenda_Logs` 
        SET `Estado_Conexion`='$Estado_Conexion',
        `Fecha_ingreso`='$Fecha_ingreso',
		`Hora_Ingreso`='$Hora_Ingreso'
         WHERE `PersonalAgenda_ID`='$PersonalAgenda_ID'";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
