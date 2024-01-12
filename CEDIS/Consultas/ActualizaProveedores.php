<?php
include "db_connection.php";

        $ID_Proveedor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ID_Provvedor']))));
       $Nombre_Proveedor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActNombresPro']))));
       $Rfc_Prov =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActRFC']))));
        $Numero_Contacto=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AcTtelefonoPro']))));
        $Correo_Electronico=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActCorreoPro']))));
        $Clave_Proveedor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActPassPro']))));
        $AgregadoPor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActUsuarioP']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActSistemaP']))));
        $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaEst']))));
        $CodigoEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaPro']))));

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