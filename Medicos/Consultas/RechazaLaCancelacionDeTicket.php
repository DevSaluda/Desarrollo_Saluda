<?php
include "db_connection.php";
                 $EstadoNuevo="Rechazado";
        $Folio_Ticket=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TicketFolioARechazar']))));
       $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($EstadoNuevo))));
    

        $sql = "UPDATE `Ventas_POS` 
        SET `Estatus`='$Estatus'
        WHERE Folio_Ticket=$Folio_Ticket";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>