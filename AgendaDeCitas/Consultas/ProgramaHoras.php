<?php
if(!empty($_POST['MedicoHoras'])  || !empty($_POST['HorasAGuardar'])|| !empty($_POST['EmpresaHoras'])){
   
    foreach($_POST['HorasAGuardar'] as $val)
{

include_once 'db_connection.php';
    
$FK_Especialista =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MedicoHoras']))));
$Fk_Programacion =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NumberProgramaHoras']))));
$ID_H_O_D	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaHoras']))));
$AgregadoPor= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioHoras']))));
$FK_Fecha= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaAsignadaParaHoras']))));
    
    //include database configuration file
    
    //insert form data in the database
    $insert = $conn->query("INSERT Horarios_Citas_Sucursales (`Horario_Disponibilidad`, `ID_H_O_D`, `FK_Especialista`,`FK_Fecha`,`Fk_Programacion`, `AgregadoPor`) VALUES 
	('".$val."','".$ID_H_O_D."','".$FK_Especialista."','".$FK_Fecha."','".$Fk_Programacion."','".$AgregadoPor."')");
}

    
}