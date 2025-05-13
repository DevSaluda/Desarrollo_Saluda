
<?php
if(!empty($_POST['sucursal'])  || !empty($_POST['nsucursal'])|| !empty($_POST['empresa'])){
include_once 'db_connection.php';
$EstatusVigencia="Vigente";
$CodigodeEstatus="background-color:#b87455 !important";

 
$ID_SucursalC=$conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['sucursal']))));
    
$Nombre_Sucursal =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['nsucursal']))));
$ID_H_O_D	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['empresa']))));
$Estatus_Sucursal= $conn -> real_escape_string(htmlentities(strip_tags(Trim($EstatusVigencia))));	
$Color_Sucursal	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($CodigodeEstatus))));
$AgregadoPor	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['usuario']))));


    
    //include database configuration file
    
    //insert form data in the database
    $sql = "INSERT INTO `Sucursales_CampañasV2`( `ID_SucursalC`,`Nombre_Sucursal`,`ID_H_O_D`,`Estatus_Sucursal`,`Color_Sucursal`,`AgregadoPor`) 
	VALUES ('$ID_SucursalC','$Nombre_Sucursal','$ID_H_O_D','$Estatus_Sucursal','$Color_Sucursal','$AgregadoPor')";

    if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
    }

    mysqli_close($conn);
}
?>




