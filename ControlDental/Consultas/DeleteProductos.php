<?php
include "db_connection.php";

        $ID_Prod_POS=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['DestroyProd']))));
     
    
        

        $sql = "DELETE FROM  `Productos_POS` 
    
        WHERE ID_Prod_POS=$ID_Prod_POS";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>