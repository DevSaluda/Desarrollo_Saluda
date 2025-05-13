<?php
if(!empty($_POST['Medico'])  || !empty($_POST['Sucursal'])|| !empty($_POST['Empresa'])){
include_once 'db_connection.php';
    
$Nombre_Sucursal =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));
$ID_H_O_D	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));
$FK_Especialista =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Medico']))));
$Estatus_Sucursal= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Estatus']))));	
$CodigoColorSu	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Color']))));

    //include database configuration file
    
    //insert form data in the database
    $insert = $conn->query("INSERT Sucursales_especialistas (Nombre_Sucursal,ID_H_O_D,FK_Especialista,Estatus_Sucursal,CodigoColorSu) VALUES 
	('".$Nombre_Sucursal."','".$ID_H_O_D."','".$FK_Especialista."','".$Estatus_Sucursal."','".$CodigoColorSu."')");
    

    
}