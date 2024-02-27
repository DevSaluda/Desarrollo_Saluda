<?php
date_default_timezone_set("America/Monterrey");
if (session_status() == PHP_SESSION_NONE) {
   session_start();
 }
 
if(!isset($_SESSION['AdminAgenda'])){
	header("Location: Expiro");
}

include_once("db_connection.php");

$sql = "SELECT Personal_Agenda.PersonalAgenda_ID,Personal_Agenda.Nombre_Apellidos,Personal_Agenda.file_name,Personal_Agenda.Estatus,
Personal_Agenda.ID_H_O_D,Personal_Agenda.Fk_Usuario,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol FROM
Personal_Agenda,Roles_Puestos wHERE Personal_Agenda.Fk_Usuario = Roles_Puestos.ID_rol AND PersonalAgenda_ID='".$_SESSION['AdminAgenda']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);
if($row['Estatus']=="Vigente" ){				

} 
else
{header("Location:Stop");
}

   ?>

