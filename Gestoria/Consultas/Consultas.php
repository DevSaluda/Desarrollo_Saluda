<?php
date_default_timezone_set("America/Monterrey");
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
if(!isset($_SESSION['VentasPos'])){
	header("Location: Expiro.php");
}
include_once("db_connection.php");
$sql ="SELECT PersonalPOS.Pos_ID,PersonalPOS.Nombre_Apellidos,PersonalPOS.file_name,PersonalPOS.Fk_Usuario,PersonalPOS.Fk_Sucursal,PersonalPOS.ID_H_O_D,PersonalPOS.Estatus,
Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,SucursalesCorre.Cuenta_Clip,SucursalesCorre.Clave_Clip,SucursalesCorre.EstadoSucursalInv from PersonalPOS,Roles_Puestos,SucursalesCorre 
where PersonalPOS.Fk_Usuario = Roles_Puestos.ID_rol and PersonalPOS.Fk_Sucursal = SucursalesCorre.ID_SucursalC and PersonalPOS.Pos_ID='".$_SESSION['VentasPos']."'"; 
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);
if($row['Estatus']=="Vigente" ){				

} 
else
{header("Location:Stop");
}


   ?>

