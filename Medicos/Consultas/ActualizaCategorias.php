<?php
include "db_connection.php";

        $Cat_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Id_Cat_Act']))));
       $Nom_Cat=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActNomCat']))));
        $Estado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActVigEst']))));
        $Cod_Estado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActVigenciaCat']))));
        $Agregado_Por=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActUsuarioC']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActSistemaC']))));
      

        $sql = "UPDATE `Categorias_POS` 
        SET `Nom_Cat`='$Nom_Cat',
        `Estado`='$Estado',
        `Cod_Estado`='$Cod_Estado', 
        `Agregado_Por`='$Agregado_Por', 
        `Sistema`='$Sistema' 
        WHERE Cat_ID=$Cat_ID";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>