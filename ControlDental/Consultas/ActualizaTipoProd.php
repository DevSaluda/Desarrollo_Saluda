<?php
include "db_connection.php";

        $Tip_Prod_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Id_TTP']))));
       $Nom_Tipo_Prod=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActNomTTP']))));
        $Estado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActVigEstTTP']))));
        $Cod_Estado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActVigenciaCat']))));
        $Agregado_Por=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActUsuarioTTP']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActSistemaTTP']))));
      

        $sql = "UPDATE `TipProd_POS` 
        SET `Nom_Tipo_Prod`='$Nom_Tipo_Prod',
        `Estado`='$Estado',
        `Cod_Estado`='$Cod_Estado', 
        `Agregado_Por`='$Agregado_Por', 
        `Sistema`='$Sistema' 
        WHERE Tip_Prod_ID=$Tip_Prod_ID";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>