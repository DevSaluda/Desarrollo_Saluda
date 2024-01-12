<?php
    include_once 'db_connection.php';

$Nombre_Proveedor=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Nombres']))));
$Rfc_Prov=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Rfc']))));
$Clave_Proveedor=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Clav']))));
$Numero_Contacto=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Contacto']))));
$Correo_Electronico=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Correo']))));
$AgregadoPor=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Agrega']))));
$Sistema=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
$Estatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaInicio']))));
$CodigoEstatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Vigencia']))));
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));    
//include database configuration file
    
    $sql = "SELECT Nombre_Proveedor,Rfc_Prov,Numero_Contacto,ID_H_O_D FROM Proveedores_POS WHERE Nombre_Proveedor='$Nombre_Proveedor' 
    AND ID_H_O_D='$ID_H_O_D' AND Rfc_Prov='$Rfc_Prov'AND Numero_Contacto='$Numero_Contacto'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Nombre_Paciente']==$Nombre_Proveedor AND $row['ID_H_O_D']==$ID_H_O_D ){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            $sql = "INSERT INTO `Proveedores_POS`( `Nombre_Proveedor`,`Rfc_Prov`,`Clave_Proveedor`,`Numero_Contacto`,`Correo_Electronico`,`AgregadoPor`,`Sistema`,`Estatus`,`CodigoEstatus`,`ID_H_O_D`) 
            VALUES ('$Nombre_Proveedor','$Rfc_Prov','$Clave_Proveedor','$Numero_Contacto','$Correo_Electronico','$AgregadoPor','$Sistema','$Estatus','$CodigoEstatus','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>