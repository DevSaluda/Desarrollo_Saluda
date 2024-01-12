<?php
if(!empty($_POST['TipoMobbb'])){
   
    foreach($_POST['CodBarraMobi'] as $val)
{

include_once 'db_connection.php';

$Cod_Equipo =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CodBarraUnico']))));
$FK_Tipo_Mob=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TipoMobbb']))));
$Cantidad_Mobil=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Cantidadmb']))));

$Nombre_equipo = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NameBB']))));
$Descripcion = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Descripcion']))));	
$Fecha_Ingreso = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaIngreso']))));
$Estatus = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EstadoMBB']))));
$CodigoEstatus = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CodEstadoMBB']))));	
$Agregado_Por = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioMBB']))));
$Sistema = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaMBB']))));		  
$ID_H_O_D	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaMBBB']))));

	
    
    //include database configuration file
    
    //insert form data in the database
    $insert = $conn->query("INSERT Inventarios_Clinicas (Cod_Equipo,Cod_Equipo_Repetido,FK_Tipo_Mob,Cantidad_Mobil,Nombre_equipo,Descripcion,Fecha_Ingreso,Estatus,
    CodigoEstatus,Agregado_Por,AgregadoEl,Sistema,ID_H_O_D)VALUES ('".$Cod_Equipo."','".$val."','".$FK_Tipo_Mob."','".$Cantidad_Mobil."','".$Nombre_equipo."','".$Descripcion."',
    '".$Fecha_Ingreso."','".$Estatus."','".$CodigoEstatus."','".$Agregado_Por."','".$AgregadoEl."','".$Sistema."','".$ID_H_O_D."')");
}

    
}