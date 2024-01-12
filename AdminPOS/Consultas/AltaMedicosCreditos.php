<?php
    include_once 'db_connection.php';

$Nombre_Med=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreMedico']))));
$Estatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaEstMedico']))));
$CodigoEstatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaMedico']))));
$Agrega=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioMedico']))));
$Sistema=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaMedico']))));

$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaMedico']))));    
//include database configuration file
    
    $sql = "SELECT Nombre_Med,Estatus,ID_H_O_D FROM Medicos_Credit_POS WHERE Nombre_Med='$Nombre_Med' AND 
     ID_H_O_D='$ID_H_O_D' AND Estatus='$Estatus'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Nombre_Med']==$Nombre_Med AND $row['ID_H_O_D']==$ID_H_O_D){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            $sql = "INSERT INTO `Medicos_Credit_POS`( `Nombre_Med`,`Estatus`,`CodigoEstatus`,`Agrega`,`Sistema`,`ID_H_O_D`) 
            VALUES ('$Nombre_Med','$Estatus','$CodigoEstatus','$Agrega','$Sistema','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>