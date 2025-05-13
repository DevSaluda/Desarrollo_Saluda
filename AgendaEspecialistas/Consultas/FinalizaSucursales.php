<?php
include "db_connection.php";


        $ID_Programacion=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ID_ProgramaF']))));
     
  

        $sql = "DELETE FROM `Programacion_Medicos_Sucursales`  WHERE ID_Programacion=$ID_Programacion";
       
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
    mysqli_close($conn);
    ?>