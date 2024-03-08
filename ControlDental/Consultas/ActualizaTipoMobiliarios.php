<?php
include "db_connection.php";

        $Tip_Mob_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Id_TTPMB']))));
       $Nom_Tip_Mob=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActNomTTPMB']))));
        $Estado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActVigEstTTPMB']))));
        $Cod_Estado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActVigenciaCatTPMB']))));
        $Agregado_Por=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActUsuarioTTPMB']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActSistemaTTPMB']))));
      

        $sql = "UPDATE `Tipos_Mobiliarios_POS` 
        SET `Nom_Tip_Mob`='$Nom_Tip_Mob',
        `Estado`='$Estado',
        `Cod_Estado`='$Cod_Estado', 
        `Agregado_Por`='$Agregado_Por', 
        `Sistema`='$Sistema' 
        WHERE Tip_Mob_ID=$Tip_Mob_ID";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>