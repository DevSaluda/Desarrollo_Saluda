<?php
include "db_connection.php";
$PagoActual="Cancelada";
$ClavePago="background-color:#FF0000 !important;";
$CitaActual="Cancelada";
$ClaveCita="background-color:#FF0000 !important;";
$SeguiActual="Cancelada";
$ClaveSegui="background-color:#FF0000 !important;";

        $ID_Agenda_Especialista=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
        $Estatus_pago= $conn -> real_escape_string(htmlentities(strip_tags(Trim($PagoActual))));
       $Color_Pago=$conn -> real_escape_string(htmlentities(strip_tags(Trim($ClavePago))));
       $Estatus_cita=$conn -> real_escape_string(htmlentities(strip_tags(Trim($CitaActual))));
       $ColorEstatusCita=$conn -> real_escape_string(htmlentities(strip_tags(Trim($ClaveCita))));
         $Estatus_Seguimiento=$conn -> real_escape_string(htmlentities(strip_tags(Trim($SeguiActual))));
         $Color_Seguimiento=$conn -> real_escape_string(htmlentities(strip_tags(Trim($ClaveSegui))));
  

        $sql = "UPDATE `AgendaCitas_EspecialistasV3` 
        SET `Estatus_pago`='$Estatus_pago',
        `Color_Pago`='$Color_Pago',
        `Estatus_cita`='$Estatus_cita',
        `ColorEstatusCita`='$ColorEstatusCita',
        `Estatus_Seguimiento`='$Estatus_Seguimiento',
        `Color_Seguimiento`='$Color_Seguimiento'
        WHERE ID_Agenda_Especialista=$ID_Agenda_Especialista";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
