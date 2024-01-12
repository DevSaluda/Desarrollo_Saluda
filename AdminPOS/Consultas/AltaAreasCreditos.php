<?php
    include_once 'db_connection.php';

$Nombre_Area=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreArea']))));
$Estatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaEstArea']))));
$CodigoEstatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaArea']))));
$Agrega=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioArea']))));
$Sistema=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaArea']))));

$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaArea']))));    
//include database configuration file
    
    $sql = "SELECT Nombre_Area,Estatus,ID_H_O_D FROM Areas_Credit_POS WHERE Nombre_Area='$Nombre_Area' AND 
     ID_H_O_D='$ID_H_O_D' AND Estatus='$Estatus'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Nombre_Area']==$Nombre_Area AND $row['ID_H_O_D']==$ID_H_O_D){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            $sql = "INSERT INTO `Areas_Credit_POS`( `Nombre_Area`,`Estatus`,`CodigoEstatus`,`Agrega`,`Sistema`,`ID_H_O_D`) 
            VALUES ('$Nombre_Area','$Estatus','$CodigoEstatus','$Agrega','$Sistema','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>