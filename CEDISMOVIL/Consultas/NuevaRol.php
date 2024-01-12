<?php
    include_once 'db_connection.php';

$Nombre_rol=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreRol']))));


$ID_H_O_D=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));
$Agrego =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Agrega']))));
$Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
    $sql = "SELECT Nombre_rol,ID_H_O_D,Sistema FROM Roles_Puestos WHERE Nombre_rol='$Nombre_rol' AND 
     ID_H_O_D='$ID_H_O_D' AND Sistema='$Sistema'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Nombre_rol']==$Nombre_rol AND $row['ID_H_O_D']==$ID_H_O_D AND $row['Sistema']==$Sistema ){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            $sql = "INSERT INTO `Roles_Puestos`( `Nombre_rol`, `ID_H_O_D`, `Agrego`, `Sistema`) 
            VALUES ( '$Nombre_rol', '$ID_H_O_D', '$Agrego', '$Sistema')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>