<?php
include "db_connection.php";

        $ID_Promo_Cred=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['idpromo']))));
       
       $CantidadADescontar=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActCostoProm'])))); 
        $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaPromEst']))));
        $CodigoEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaProm']))));
        $Agrega=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioPromo']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaPromo']))));
      

        $sql = "UPDATE `Promos_Credit_POS` 
        SET  `CantidadADescontar`='$CantidadADescontar',
        `Estatus`='$Estatus',
        `CodigoEstatus`='$CodigoEstatus', 
        `Agrega`='$Agrega', 
        `Sistema`='$Sistema' 
        WHERE ID_Promo_Cred=$ID_Promo_Cred";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>