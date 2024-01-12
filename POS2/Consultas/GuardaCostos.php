<?php
if(!empty($_POST['Medico'])  || !empty($_POST['Costo'])|| !empty($_POST['Empresa'])|| !empty($_POST['Empleado'])){
include_once 'db_connection.php';
    
$Costo_Especialista =  $conn -> real_escape_string(htmlentities(strip_tags($_POST['Costo'])));
$FK_Especialista =  $conn -> real_escape_string(htmlentities(strip_tags($_POST['Medico'])));
$ID_H_O_D	= $conn -> real_escape_string(htmlentities(strip_tags($_POST['Empresa'])));
$UsuarioAnade	= $conn -> real_escape_string(htmlentities(strip_tags($_POST['Empleado'])));
$Estatus	= $conn -> real_escape_string(htmlentities(strip_tags($_POST['Estatus'])));
$Codigocolor	= $conn -> real_escape_string(htmlentities(strip_tags($_POST['Color'])));

    
    //include database configuration file
    
    //insert form data in the database
    $insert = $conn->query("INSERT Costos_Especialistas (Costo_Especialista,ID_H_O_D,FK_Especialista,UsuarioAnade,Estatus,Codigocolor) VALUES 
	('".$Costo_Especialista."','".$ID_H_O_D."','".$FK_Especialista."','".$UsuarioAnade."','".$Estatus."','".$Codigocolor."')");
    

    
}