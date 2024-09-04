<?php
if(!empty($_POST['Medico'])  || !empty($_POST['Fecha'])|| !empty($_POST['Empresa'])){
   
    foreach($_POST['Fecha'] as $val)
{

include_once 'db_connection.php';
    
$FK_Especialista =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Medico']))));
$ID_H_O_D	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));
$Estatus_fecha	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Estatus']))));
$CodigoColorFe	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Color']))));	
    
    
    //include database configuration file
    
    //insert form data in the database
    $insert = $conn->query("INSERT  Fechas_Especialistas (Fecha_Disponibilidad,ID_H_O_D,FK_Especialista,Estatus_fecha,CodigoColorFe) VALUES 
	('".$val."','".$ID_H_O_D."','".$FK_Especialista."','".$Estatus_fecha."','".$CodigoColorFe."')");
}

    
}