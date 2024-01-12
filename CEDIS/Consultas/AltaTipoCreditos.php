<?php
    include_once 'db_connection.php';

$Nombre_Tip=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreCredito']))));
$Costo=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Costo']))));
$Estatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaEst']))));
$CodigoEstatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Vigencia']))));
$Agrega=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));
$Sistema=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));

$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));    
//include database configuration file
    
    $sql = "SELECT Nombre_Tip,Costo,Estatus,ID_H_O_D FROM Tipos_Credit_POS WHERE Nombre_Tip='$Nombre_Tip' AND 
     ID_H_O_D='$ID_H_O_D' AND Costo='$Costo' AND Estatus='$Estatus'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Nombre_Tip']==$Nombre_Tip AND $row['ID_H_O_D']==$ID_H_O_D AND $row['Costo']==$Costo){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            $sql = "INSERT INTO `Tipos_Credit_POS`( `Nombre_Tip`,`Costo`,`Estatus`,`CodigoEstatus`,`Agrega`,`Sistema`,`ID_H_O_D`) 
            VALUES ('$Nombre_Tip','$Costo','$Estatus','$CodigoEstatus','$Agrega','$Sistema','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>