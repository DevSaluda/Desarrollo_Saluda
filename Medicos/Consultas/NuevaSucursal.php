<?php
    include_once 'db_connection.php';

$Nombre_Sucursal=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));
$Telefono=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalT']))));

$ID_H_O_D=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));
$Agrego =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Agrega']))));
$Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
    $sql = "SELECT Nombre_Sucursal,ID_H_O_D,Sistema FROM SucursalesCorre WHERE Nombre_Sucursal='$Nombre_Sucursal' AND 
     ID_H_O_D='$ID_H_O_D' AND Sistema='$Sistema'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Nombre_Sucursal']==$Nombre_Sucursal AND $row['ID_H_O_D']==$ID_H_O_D AND $row['Sistema']==$Sistema ){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            $sql = "INSERT INTO `SucursalesCorre`( `Nombre_Sucursal`, `ID_H_O_D`, `Telefono`,  `Agrego`, `Sistema`) 
            VALUES ( '$Nombre_Sucursal', '$ID_H_O_D', '$Telefono', '$Agrego', '$Sistema')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>