<?php
include "db_connection.php";


        $ID_Proce=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ProcedimientoAEliminar']))));
     
  

        $sql = "DELETE FROM `Procedimientos_Medicos`  WHERE ID_Proce=$ID_Proce";
       
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
    mysqli_close($conn);
    ?>