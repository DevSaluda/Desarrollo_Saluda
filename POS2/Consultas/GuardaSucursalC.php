<?php
if(!empty($_POST['Estatus'])  || !empty($_POST['Sucursal'])|| !empty($_POST['Empresa'])){
include_once 'db_connection.php';
    
$Nombre_Sucursal =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));
$ID_H_O_D	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));
$Estatus_Sucursal= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Estatus']))));	
$Color_Sucursal	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Color']))));

    //include database configuration file
    
    //insert form data in the database
    $insert = $conn->query("INSERT Sucursales_Campañas (Nombre_Sucursal,ID_H_O_D,Estatus_Sucursal,Color_Sucursal) VALUES 
	('".$Nombre_Sucursal."','".$ID_H_O_D."','".$Estatus_Sucursal."','".$Color_Sucursal."')");
    

    
}