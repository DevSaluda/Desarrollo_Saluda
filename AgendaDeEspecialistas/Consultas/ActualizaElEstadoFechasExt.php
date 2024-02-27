<?php
include "db_connection.php";


        $ID_Programacion=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ID_Programa']))));
        $ProgramadoPor= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioAutorizo']))));
       $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaAutorizo']))));
       $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EstadoProgramacion']))));
  

        $sql = "UPDATE `Programacion_MedicosExt` 
        SET `ProgramadoPor`='$ProgramadoPor',
        `Sistema`='$Sistema',
        `Estatus`='$Estatus'
        WHERE ID_Programacion=$ID_Programacion";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
