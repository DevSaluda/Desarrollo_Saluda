<?php
 include_once 'db_connection.php';

$Nombre_Apellidos =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['nombres'])))); 
$Curp =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['curp']))));     
$Fecha_Nacimiento =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['fechan']))));  
$RFC =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['rfc'])))); 
$Sexo =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['sexo']))));      
$Estado_civil =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['estadoc']))));  
$Correo_Electronico =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['correo']))));     
$Telefono =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['tel1']))));    
$Telefono_particular =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['tel2']))));      
$NSS =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['nss']))));
$Alergias =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['alergias']))));   
$Tipo_sangre =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['sangre']))));     
$Calle =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['calle']))));    
$NInterior =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['next']))));   
$NExterior =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['nint']))));
$Cruzamientos =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['cruzamientos']))));   
$Colonia =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['colonia']))));   
$Cp =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['cp']))));     
$Estado =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['estador']))));   
$Municipio =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['municipior']))));   
$Localidad =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['localidadr']))));    
$ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['empresa']))));   
$Folio_Contrato =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['folioc']))));  
$AgregadoPor =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['usuario']))));
$Contacto1 =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['familiar1']))));     
$Contacto2 =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['familiar2'])))); 
$Parentezco1 =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['p1'])))); 
$Parentezco2 =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['p2']))));  
$C_Emerge1 =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['telf1']))));  
$C_Emerge2 =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['telf2']))));   
$Sistema =  $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['sistema']))));    
    //insert form data in the database
    $sql = "INSERT INTO `Datos_Generales_Personal`(`Nombre_Apellidos`,`Curp`,`Fecha_Nacimiento`,`RFC`,`Sexo`,`Estado_civil`,`Correo_Electronico`,`Telefono`,`Telefono_particular`,`NSS`,`Alergias`,`Tipo_sangre`,`Calle`,`NInterior`,`NExterior`,`Cruzamientos`,`Colonia`,`Cp`,`Estado`,`Municipio`,`Localidad`,`ID_H_O_D`,`Folio_Contrato`,`AgregadoPor`,`Contacto1`,`Contacto2`,`Parentezco1`,`Parentezco2`,`C_Emerge1`,`C_Emerge2`,`Sistema`) 
	VALUES ('$Nombre_Apellidos','$Curp','$Fecha_Nacimiento','$RFC','$Sexo','$Estado_civil','$Correo_Electronico','$Telefono','$Telefono_particular','$NSS','$Alergias','$Tipo_sangre','$Calle','$NInterior','$NExterior','$Cruzamientos','$Colonia','$Cp','$Estado','$Municipio','$Localidad','$ID_H_O_D','$Folio_Contrato','$AgregadoPor','$Contacto1','$Contacto2','$Parentezco1','$Parentezco2','$C_Emerge1','$C_Emerge2','$Sistema')";

    if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>
