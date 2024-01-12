<?php
if(!empty($_POST['Nombres'])  || !empty($_POST['Especialidad'])   || !empty($_POST['Tel']) || !empty($_POST['Empresa'])){  
 
include_once 'db_connection.php';
    
$Nombre_Apellidos =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['Nombres']))));
$Especialidad =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['Especialidad']))));
$Tel = $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['Tel']))));
$ID_H_O_D = $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['Empresa']))));
$Fk_Sucursal = $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['Sucursal']))));
$Estatus_Especialista= $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['Estatus']))));
$CodigoColorEs= $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['Color']))));	
    
    
    //include database configuration file
    
    //insert form data in the database
    $insert = $conn->query("INSERT Especialistas (Nombre_Apellidos,Especialidad,Tel,ID_H_O_D,Fk_Sucursal,Estatus_Especialista,CodigoColorEs) VALUES 
	('".$Nombre_Apellidos."','".$Especialidad."','".$Tel."','".$ID_H_O_D."','".$Fk_Sucursal."','".$Estatus_Especialista."','".$CodigoColorEs."')");
    

    
}