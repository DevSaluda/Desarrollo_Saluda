<?php
if(!empty($_POST['Especialidad'])  || !empty($_POST['Empresa'])){
include_once 'db_connection.php';
    
$Nombre_Especialidad =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['Especialidad']))));
$Fk_Sucursal=  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['Sucursal']))));
$ID_H_O_D	= $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['Empresa']))));
$Estatus_Especialidad= $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['Estatus']))));
$Codigocolor= $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['Color']))));


	
    
    
    //include database configuration file
    
    //insert form data in the database
    $insert = $conn->query("INSERT  Especialidades (Nombre_Especialidad,Fk_Sucursal,ID_H_O_D,Estatus_Especialidad,CodigoColor) VALUES 
	('".$Nombre_Especialidad."','".$Fk_Sucursal."','".$ID_H_O_D."','".$Estatus_Especialidad."','".$Codigocolor."')");
    

    
}