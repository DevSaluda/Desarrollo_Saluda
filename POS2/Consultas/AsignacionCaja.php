<?php
include "db_connection.php";
     $Dejalosincaja=1;
        $ID_Caja=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['IDdeCajaAsignada']))));
       $Asignacion=$conn -> real_escape_string(htmlentities(strip_tags(Trim($Dejalosincaja))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaCajaa']))));
      

        $sql = "UPDATE `Cajas_POS` 
        SET `Asignacion`='$Asignacion', 
        `Sistema`='$Sistema' 
        WHERE ID_Caja=$ID_Caja";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>