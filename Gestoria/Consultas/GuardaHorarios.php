<?php
include_once 'db_connection.php';
foreach($_POST['Horas'] as $val)
{

$FK_Especialista =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Especialista']))));
$ID_H_O_D	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));
$Estatus_Horario= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Estatus']))));	
$CodigoColorHo	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Color']))));
$Fk_Fecha	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Fecha']))));


    //include database configuration file
    
    //insert form data in the database
    $insert = $conn->query("INSERT  Horarios_Citas_especialistas (Horario_Disponibilidad,ID_H_O_D,FK_Especialista,Fk_Fecha,Estatus_Horario,CodigoColorHo) VALUES 
	('".$val."','".$ID_H_O_D."','".$FK_Especialista."','".$Fk_Fecha."','".$Estatus_Horario."','".$CodigoColorHo."')");
    }

    

?>