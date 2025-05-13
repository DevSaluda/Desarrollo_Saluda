<?php
if(!empty($_POST['Medico'])  || !empty($_POST['FechasAguardar'])|| !empty($_POST['Empresa'])){
   
    foreach($_POST['FechasAguardar'] as $val)
{

include_once 'db_connection.php';
    
$FK_Especialista =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Medico']))));
$Fk_Programacion =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NumberPrograma']))));
$ID_H_O_D	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));
$Agrego= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioA']))));
    
    
    //include database configuration file
    
    //insert form data in the database
    $insert = $conn->query("INSERT Fechas_EspecialistasExt (`Fecha_Disponibilidad`, `ID_H_O_D`, `FK_Especialista`, `Fk_Programacion`, `Agrego`) VALUES 
	('".$val."','".$ID_H_O_D."','".$FK_Especialista."','".$Fk_Programacion."','".$Agrego."')");
}

    
}