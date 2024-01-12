<?php
include "db_connection.php";

        $Marca_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Id_Mar_Act']))));
       $Nom_Marca=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActNomMar']))));
        $Estado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActVigEstM']))));
        $Cod_Estado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActVigenciaMar']))));
        $Agregado_Por=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActUsuarioM']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActSistemaM']))));
      

        $sql = "UPDATE `Marcas_POS` 
        SET `Nom_Marca`='$Nom_Marca',
        `Estado`='$Estado',
        `Cod_Estado`='$Cod_Estado', 
        `Agregado_Por`='$Agregado_Por', 
        `Sistema`='$Sistema' 
        WHERE Marca_ID=$Marca_ID";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>