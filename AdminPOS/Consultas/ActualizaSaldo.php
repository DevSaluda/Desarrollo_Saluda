<?php
include "db_connection.php";

$Folio_Credito=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['IDFolio']))));
        $Saldo=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Ajuste']))));
       
        $sql = "UPDATE `Creditos_POS` 
         SET `Saldo`='$Saldo'
 WHERE Folio_Credito=$Folio_Credito";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>400));
	} 
	else {
		echo json_encode(array("statusCode"=>401));
	}
	mysqli_close($conn);
