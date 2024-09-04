<?php
include "db_connection.php";


        $Id_genda=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['idcancela']))));
     
  

        $sql = "DELETE FROM `Agenda_revaloraciones`  WHERE Id_genda=$Id_genda";
       
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
    mysqli_close($conn);
    ?>