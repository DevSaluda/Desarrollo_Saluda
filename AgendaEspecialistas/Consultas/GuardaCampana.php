<?php
if(!empty($_POST['Especialidad'])  || !empty($_POST['Medico'])|| !empty($_POST['Fecha']) || !empty($_POST['Hora']) || !empty($_POST['Empresa'])){
include_once 'db_connection.php';
    
$Especialidad=  $conn -> real_escape_string(htmlentities(strip_tags($_POST['Especialidad'])));
$NombreEspecialista	= $conn -> real_escape_string(htmlentities(strip_tags($_POST['Medico'])));
$Fecha_disponible	= $conn -> real_escape_string(htmlentities(strip_tags($_POST['Fecha'])));
$Hora_Cita= $conn -> real_escape_string(htmlentities(strip_tags($_POST['Hora'])));
$ID_H_O_D	= $conn -> real_escape_string(htmlentities(strip_tags($_POST['Empresa'])));
	
	
    
    //include database configuration file
    
    //insert form data in the database
    $insert = $conn->query("INSERT Campañas_Especialistas (Especialidad,NombreEspecialista,Fecha_disponible,Hora_Cita,ID_H_O_D) VALUES 
	('".$Especialidad."','".$NombreEspecialista."','".$Fecha_disponible."','".$Hora_Cita."','".$ID_H_O_D."')");
    

    
}