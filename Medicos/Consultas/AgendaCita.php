<?php
if(!empty($_POST['Especialidad'])  || !empty($_POST['Medico'])|| !empty($_POST['Sucursal'])
|| !empty($_POST['TipoConsulta'])|| !empty($_POST['Colorpago'])|| !empty($_POST['Colorcita'])|| !empty($_POST['Telefono'])
|| !empty($_POST['Costo'])|| !empty($_POST['Observaciones'])|| !empty($_POST['EstatusPago'])|| !empty($_POST['EstatusCita'])
|| !empty($_POST['EstatusSeguimiento'])|| !empty($_POST['ColorSigue'])|| !empty($_POST['Empresa'])){
include_once 'db_connection.php';
    
$Fk_Especialidad =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Especialidad']))));
$Fk_Especialista	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Medico']))));
$Fk_Sucursal =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));
$Fk_Fecha= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Fecha']))));	
$Fk_Hora	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Hora']))));
$Fk_Costo= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Costo']))));	
$Nombre_Paciente= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreP']))));
$Telefono	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Telefono']))));	
$Tipo_Consulta	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TipoConsulta']))));
$Estatus_pago= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EstatusPago']))));	
$Color_Pago	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Colorpago']))));
$Estatus_cita= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EstatusCita']))));	
$Observaciones	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Observaciones']))));
$ColorEstatusCita =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Colorcita']))));
$Estatus_Seguimiento   =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EstatusSeguimiento']))));
$Color_Seguimiento	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ColorSigue']))));
$ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));
$AgendadoPor =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AgendaPor']))));
$Sistema =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
    //include database configuration file
    
    //insert form data in the database
     $insert = $conn->query("INSERT  AgendaCitas_Especialistas (Fk_Especialidad,Fk_Especialista,Fk_Sucursal,Fk_Fecha,Fk_Hora,Fk_Costo,
     Nombre_Paciente,Telefono,Tipo_Consulta,Estatus_pago,Color_Pago,Estatus_cita,Observaciones,ColorEstatusCita,Estatus_Seguimiento,
     Color_Seguimiento,ID_H_O_D,AgendadoPor,Sistema) VALUES 
('".$Fk_Especialidad."','".$Fk_Especialista."','".$Fk_Sucursal."','".$Fk_Fecha."','".$Fk_Hora."','".$Fk_Costo."','".$Nombre_Paciente."',
'".$Telefono."','".$Tipo_Consulta."','".$Estatus_pago."','".$Color_Pago."','".$Estatus_cita."','".$Observaciones."','".$ColorEstatusCita."',
'".$Estatus_Seguimiento."','".$Color_Seguimiento."','".$ID_H_O_D."','".$AgendadoPor."','".$Sistema."')");
    

    
}