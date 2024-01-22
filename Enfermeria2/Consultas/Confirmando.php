<?php
include "db_connection.php";
        $ID_Data_Paciente=$_POST['id'];
        $Nombre_Paciente=$_POST['nombres'];
        $Fecha_Nacimiento=$_POST['fechaNac'];
        $Edad=$_POST['edad'];
        $Sexo=$_POST['sexo'];
        $Alergias=$_POST['alergias'];
        $Telefono=$_POST['tel'];
        $Correo=$_POST['correo'];

        $sql = "UPDATE `Data_Pacientes` 
        SET `Nombre_Paciente`='$Nombre_Paciente',
        `Fecha_Nacimiento`='$Fecha_Nacimiento',
        `Edad`='$Edad',
        `Sexo`='$Sexo',
        `Alergias`='$Alergias',
        `Telefono`='$Telefono',
        `Correo`='$Correo'
        WHERE ID_Data_Paciente=$ID_Data_Paciente";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>