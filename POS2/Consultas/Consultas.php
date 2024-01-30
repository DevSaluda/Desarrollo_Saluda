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
Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,SucursalesCorre.Cuenta_Clip,SucursalesCorre.Clave_Clip from PersonalPOS,Roles_Puestos,SucursalesCorre 
where PersonalPOS.Fk_Usuario = Roles_Puestos.ID_rol and PersonalPOS.Fk_Sucursal = SucursalesCorre.ID_SucursalC and PersonalPOS.Pos_ID='".$_SESSION['VentasPos']."'"; 
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);
if($row['Estatus']=="Vigente" ){				

} 
else
{header("Location:Stop");
}

$hora = date('G'); if (($hora >= 0) AND ($hora < 6)) 
  { 
    
    $mensaje = "Hola, que tengas una excelente madrugada."; 
  } 
  else if (($hora >= 6) AND ($hora < 12)) 
  { 
    $mensaje = "Buenos días"; 
  } 
  else if (($hora >= 12) AND ($hora < 18)) 
  { 
    $mensaje = "Buenas tardes"; 
  } 
  else
  { 
  $mensaje = "Buenas noches"; 
  } 
  $fkSucursal = $row['Fk_Sucursal'];
  $idHOD = $row['ID_H_O_D'];
  
  // Establecer cookies
  setcookie("Fk_Sucursal", $fkSucursal, time() + 3600, "/"); // Caduca en 1 hora (puedes ajustar el tiempo)
  setcookie("ID_H_O_D", $idHOD, time() + 3600, "/"); // Caduca en 1 hora (puedes ajustar el tiempo)
   ?>

