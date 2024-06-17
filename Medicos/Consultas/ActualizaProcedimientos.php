<?php
include "db_connection.php";

        $ID_Proce=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ID_ProcedimientoAct']))));
       
        $Codigo_Procedimiento=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CodigoProcedimientoACT']))));
        $Nombre_Procedimiento=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreProcedimientoACT']))));
        $Costo_Procedimiento=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CostoProcedimientoACT']))));
        $AgregadoPor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AcTUser']))));
       
        $sql = "UPDATE `Procedimientos_Medicos` 
        SET 
        `Codigo_Procedimiento`='$Codigo_Procedimiento',
        `Nombre_Procedimiento`='$Nombre_Procedimiento',
        `Costo_Procedimiento`='$Costo_Procedimiento',
        `AgregadoPor`='$AgregadoPor'
        
WHERE ID_Proce=$ID_Proce";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>