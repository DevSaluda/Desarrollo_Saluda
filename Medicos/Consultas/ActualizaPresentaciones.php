<?php
include "db_connection.php";

        $Pprod_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Id_Cat_Pre']))));
       $Nom_Presentacion=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActNombrepresentacion']))));
       $Siglas=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActSiglaspresentacion']))));
        $Estado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActVigEstP']))));
        $Cod_Estado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActVigenciaPre']))));
        $Agregado_Por=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActUsuarioP']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActSistemaP']))));
      

        $sql = "UPDATE `Presentacion_Prod_POS` 
        SET `Nom_Presentacion`='$Nom_Presentacion',
        `Siglas`='$Siglas',
        `Estado`='$Estado',
        `Cod_Estado`='$Cod_Estado', 
        `Agregado_Por`='$Agregado_Por', 
        `Sistema`='$Sistema' 
        WHERE Pprod_ID=$Pprod_ID";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
