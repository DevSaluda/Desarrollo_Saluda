
<?
date_default_timezone_set("America/Monterrey");
session_start();
if(!isset($_SESSION['JefeEnfermeros'])){
	header("Location: Expiro.php");
}
include_once("../db_connect.php");
$sql = "SELECT Personal_Enfermeria.Enfermero_ID,Personal_Enfermeria.Nombre_Apellidos,Personal_Enfermeria.file_name,Personal_Enfermeria.Fk_Sucursal,
Personal_Enfermeria.ID_H_O_D,Personal_Enfermeria.Fk_Usuario, Roles_Puestos.ID_rol, Roles_Puestos.Nombre_rol,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Personal_Enfermeria,Roles_Puestos,SucursalesCorre 
where Personal_Enfermeria.Fk_Usuario = Roles_Puestos.ID_rol AND Personal_Enfermeria.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
  and Personal_Enfermeria.Enfermero_ID='".$_SESSION['JefeEnfermeros']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);
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

