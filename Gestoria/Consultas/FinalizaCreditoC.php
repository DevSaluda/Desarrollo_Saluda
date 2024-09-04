<?php
include "db_connection.php";

$Folio_Credito=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FolioF']))));
$Estatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EstatusCC']))));
$CodigoEstatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CodigoCC']))));
        
       
        $sql = "UPDATE `Creditos_Clinicas_POS` 
         SET `Estatus`='$Estatus',
         `CodigoEstatus`='$CodigoEstatus'
 WHERE Folio_Credito=$Folio_Credito";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
