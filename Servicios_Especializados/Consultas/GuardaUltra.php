<?php

	$Nombre_paciente = $_POST['Nombre'];
	$Telefono= $_POST['Tel'];
    $ID_Sucursal=$_POST['Sucursal'];
    $Estatus=$_POST['Estatus'];
    $Codigo_color=$_POST['Color'];
    
    //include database configuration file
    include_once 'dbConfig.php';
    
    //insert form data in the database
    $insert = $db->query("INSERT Resultados_Ultrasonidos (Nombre_paciente,Telefono,ID_Sucursal,Estatus,Codigo_Color) VALUES 
	('".$Nombre_paciente."','".$Telefono."','".$ID_Sucursal."','".$Estatus."','".$Codigo_color."')");
    
