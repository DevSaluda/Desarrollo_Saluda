
<?php
include "db_connection.php";
                $InfoState="Entregado,con detalles o incompleto";
        $ID_Traspaso_Generado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['IDTraspasoActualiza']))));
       $TraspasoRecibidoPor= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreRecibio']))));
        $Estatus= $conn -> real_escape_string(htmlentities(strip_tags(Trim($InfoState))));
        $sql = "UPDATE `Traspasos_generados` 
        SET `Estatus`='$Estatus',
        `TraspasoRecibidoPor`='$TraspasoRecibidoPor'
        WHERE ID_Traspaso_Generado=$ID_Traspaso_Generado";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>