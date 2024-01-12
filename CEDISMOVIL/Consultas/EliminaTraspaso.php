<?php
include "db_connection.php";


        $ID_Traspaso_Generado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CancelacionTraspasoCedis']))));
     
  

        $sql = "DELETE FROM `Traspasos_generados`  WHERE ID_Traspaso_Generado=$ID_Traspaso_Generado";
       
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
    mysqli_close($conn);
    ?>