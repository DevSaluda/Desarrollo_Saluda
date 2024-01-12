<?php
include "db_connection.php";
$ClaveEstatus="Cancelacion";

        $Folio_Ticket=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NumberTicket']))));
        $Fk_sucursal=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FK_SUCURSAL']))));
        $Fk_Caja=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FK_CAJA']))));
        $Motivo_cancelacion=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MotivoCancela']))));
        $AgregadoPor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioSC']))));
        $Estatus= $conn -> real_escape_string(htmlentities(strip_tags(Trim( $ClaveEstatus))));
       
   
       
  

        $sql = "UPDATE `Ventas_POS`
        SET `Estatus` = '$Estatus',
        `Motivo_Cancelacion`='$Motivo_cancelacion'
         where `Folio_Ticket` = '$Folio_Ticket' AND 
         `Fk_sucursal`='$Fk_sucursal' AND `Fk_Caja`='$Fk_Caja'";

       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>