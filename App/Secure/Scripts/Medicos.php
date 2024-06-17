<?php
session_start();
include_once("../db_connect.php");
if(isset($_POST['login_button'])) {
	$Correo_electronico = trim($_POST['user_email']);
	$Password = trim($_POST['password']);
	
	$sql = "SELECT Pos_ID,Nombre_Apellidos,Password,Correo_Electronico,ID_H_O_D,Fk_Usuario 
	FROM PersonalPOS WHERE Correo_electronico='$Correo_electronico'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$row = mysqli_fetch_assoc($resultset);	
		

}
?>
