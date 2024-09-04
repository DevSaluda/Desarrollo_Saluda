<?php
    include_once 'db_connection.php';

$Fk_tipo_Credi=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AreaC']))));
$Nombre_Cred=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreReal']))));

$Cant_Apertura=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ValC']))));
$Fecha_Inicio=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaInicioC']))));
$Fecha_Termino=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaTerminoc']))));
$Fk_Sucursal=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalC']))));

$Estatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EstatusC']))));
$CodigoEstatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CodEstatusC']))));
$Agrega=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AgendaPorC']))));
$Sistema=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaC']))));
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaC']))));   
$Saldo= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ValC']))));
//include database configuration file
    
    $sql = "SELECT Fk_tipo_Credi,Nombre_Cred,Cant_Apertura,Fecha_Inicio,Fecha_Termino,Fk_Sucursal,ID_H_O_D FROM Creditos_Clinicas_POS WHERE Fk_tipo_Credi='$Fk_tipo_Credi' AND 
     ID_H_O_D='$ID_H_O_D' AND Nombre_Cred='$Nombre_Cred' AND Cant_Apertura='$Cant_Apertura' AND Fecha_Inicio='$Fecha_Inicio'AND Fecha_Termino='$Fecha_Termino' AND Fk_Sucursal='$Fk_Sucursal'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Fk_tipo_Credi']==$Fk_tipo_Credi AND $row['ID_H_O_D']==$ID_H_O_D AND $row['Nombre_Cred']==$Nombre_Cred AND $row['Fecha_Inicio']==$Fecha_Inicio AND $row['Fecha_Termino']==$Fecha_Termino
        AND $row['Fk_Sucursal']==$Fk_Sucursal ){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            $sql = "INSERT INTO `Creditos_Clinicas_POS`(`Fk_tipo_Credi`, `Nombre_Cred`, `Cant_Apertura`, `Fecha_Inicio`, `Fecha_Termino`, `Fk_Sucursal`, `Estatus`, `CodigoEstatus`, `Agrega`, `Sistema`, `ID_H_O_D`, `Saldo`) 
            VALUES ('$Fk_tipo_Credi', '$Nombre_Cred', '$Cant_Apertura', '$Fecha_Inicio','$Fecha_Termino', '$Fk_Sucursal', '$Estatus','$CodigoEstatus', '$Agrega','$Sistema', '$ID_H_O_D', '$Saldo')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>