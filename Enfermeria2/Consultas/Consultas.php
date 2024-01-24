<?php
date_default_timezone_set("America/Monterrey");
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if(!isset($_SESSION['Enfermeria'])){
	header("Location: Expiro.php");
}
include_once("db_connection.php");
$sql = "SELECT Personal_Enfermeria.Enfermero_ID,Personal_Enfermeria.Nombre_Apellidos,Personal_Enfermeria.file_name,Personal_Enfermeria.Fk_Sucursal,Personal_Enfermeria.Estatus,
Personal_Enfermeria.ID_H_O_D,Personal_Enfermeria.Fk_Usuario, Roles_Puestos.ID_rol, Roles_Puestos.Nombre_rol,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,SucursalesCorre.Url_Drive_Enfermeria FROM Personal_Enfermeria,Roles_Puestos,SucursalesCorre where Personal_Enfermeria.Fk_Usuario = Roles_Puestos.ID_rol AND Personal_Enfermeria.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
  and Personal_Enfermeria.Enfermero_ID='".$_SESSION['Enfermeria']."'";
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

   ?>

