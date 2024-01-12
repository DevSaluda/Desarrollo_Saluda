<?php
include "db_connection.php";

        $ID_Prod_POS=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ACT_ID_Prod']))));
        $Nombre_Prod=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NameDescrip']))));
        $Stock=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['lestock']))));
        $Lote_Med=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Loteee']))));
        $Precio_Venta=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ACASPV']))));
        $Precio_C=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['pcc']))));
        $Min_Existencia=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ACAsMinimo']))));
        $Max_Existencia	=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ACAsMaximo']))));
        $Fecha_Caducidad=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['fechacad']))));
        $AgregadoPor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AgregaProductosBy']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaProductos']))));
        $Clave_adicional=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ClaveAdicional']))));
        $Clave_Levic=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ClaveLevic']))));
        $Cod_Enfermeria=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ClaveEnfermeria']))));

        

        $sql = "UPDATE `Productos_POS` 
        SET 
        `Nombre_Prod`='$Nombre_Prod',
        `Stock`='$Stock',
        `Cod_Enfermeria`='$Cod_Enfermeria',
        `Precio_Venta`='$Precio_Venta',
        `Precio_C`='$Precio_C',
        `Min_Existencia`='$Min_Existencia',
        `Max_Existencia`='$Max_Existencia',
        `Lote_Med`='$Lote_Med',
        `Fecha_Caducidad`='$Fecha_Caducidad',
        `AgregadoPor`='$AgregadoPor',
        `Clave_adicional`='$Clave_adicional',
        `Clave_Levic`='$Clave_Levic',
        `Sistema`='$Sistema'
WHERE ID_Prod_POS=$ID_Prod_POS";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
