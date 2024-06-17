<?php
include "db_connection.php";

        $ID_Proveedor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ID_Prospectos']))));
       $Nombre_Proveedor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActNombresPros']))));
       $Rfc_Prov =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActRFCs']))));
        $Numero_Contacto=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AcTtelefonoPros']))));
        $Correo_Electronico=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActCorreoPros']))));
        $Clave_Proveedor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActPassPros']))));
        $AgregadoPor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActUsuarioPs']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActSistemaPs']))));
        $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaEsts']))));
        $CodigoEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaPros']))));

        $sql = "UPDATE `Proveedores_POS` 
        SET `Nombre_Proveedor`='$Nombre_Proveedor',
        `Rfc_Prov`='$Rfc_Prov',
        `Numero_Contacto`='$Numero_Contacto',
        `Correo_Electronico`='$Correo_Electronico',
        `Clave_Proveedor`='$Clave_Proveedor',
        `AgregadoPor`='$AgregadoPor',
        `Sistema`='$Sistema',
        `Estatus`='$Estatus',
        `CodigoEstatus`='$CodigoEstatus' 
        WHERE ID_Proveedor=$ID_Proveedor";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>