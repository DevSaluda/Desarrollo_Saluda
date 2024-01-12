<?php
    include_once 'db_connection.php';

$Fk_tipo_Credi=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TipoCred']))));
$Nombre_Cred=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Nombres']))));
$Edad=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Edad']))));
$Sexo=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sexo']))));
$Direccion=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Direccion']))));
$Telefono=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Tel']))));
$Cant_Apertura=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CostoReal']))));
$Costo_Tratamiento =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Costoo']))));
$Fecha_Apertura=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaI']))));
$Fecha_Termino=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaF']))));
$Fk_Sucursal=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));
$Odontologo=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Odo']))));
$Estatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Estatus']))));
$CodigoEstatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CodEstatus']))));
$Agrega=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AgendaPor']))));
$Sistema=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));   
$Promocion=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['PromoReal']))));
$Costo_Descuento=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Descuento']))));
$Validez=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaF']))));
$Area=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Area']))));
$Saldo= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CostoReal']))));
//include database configuration file
    
    $sql = "SELECT Fk_tipo_Credi,Nombre_Cred,Cant_Apertura,Fecha_Apertura,Fecha_Termino,Fk_Sucursal,ID_H_O_D FROM Creditos_POS WHERE Fk_tipo_Credi='$Fk_tipo_Credi' AND 
     ID_H_O_D='$ID_H_O_D' AND Nombre_Cred='$Nombre_Cred' AND Cant_Apertura='$Cant_Apertura' AND Fecha_Apertura='$Fecha_Apertura'AND Fecha_Termino='$Fecha_Termino' AND Fk_Sucursal='$Fk_Sucursal'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Fk_tipo_Credi']==$Fk_tipo_Credi AND $row['ID_H_O_D']==$ID_H_O_D AND $row['Nombre_Cred']==$Nombre_Cred AND $row['Fecha_Apertura']==$Fecha_Apertura AND $row['Fecha_Termino']==$Fecha_Termino
        AND $row['Fk_Sucursal']==$Fk_Sucursal ){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            $sql = "INSERT INTO `Creditos_POS`( `Fk_tipo_Credi`,`Nombre_Cred`,`Edad`,`Sexo`,`Direccion`,`Telefono`,`Cant_Apertura`,`Costo_Tratamiento`,`Fecha_Apertura`,`Fecha_Termino`,`Fk_Sucursal`,`Odontologo`,`Estatus`,`CodigoEstatus`,`Agrega`,`Sistema`,`ID_H_O_D`,`Promocion`,`Costo_Descuento`,`Validez`,`Area`,`Saldo`) 
            VALUES ('$Fk_tipo_Credi','$Nombre_Cred','$Edad','$Sexo','$Direccion','$Telefono','$Cant_Apertura','$Costo_Tratamiento','$Fecha_Apertura','$Fecha_Termino','$Fk_Sucursal','$Odontologo','$Estatus','$CodigoEstatus','$Agrega','$Sistema','$ID_H_O_D','$Promocion','$Costo_Descuento','$Validez','$Area','$Saldo')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>