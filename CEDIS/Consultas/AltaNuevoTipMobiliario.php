<?php
    include_once 'db_connection.php';

$Nom_Tip_Mob=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreTipoMobi']))));
$Estado=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaTPM']))));
$Cod_Estado=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaMobi']))));
$Agregado_Por=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioTPM']))));
$Sistema=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaTPM']))));
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaTPM']))));    
//include database configuration file
    
    $sql = "SELECT Nom_Tip_Mob,Estado,ID_H_O_D FROM Tipos_Mobiliarios_POS WHERE Nom_Tip_Mob='$Nom_Tip_Mob' 
    AND ID_H_O_D='$ID_H_O_D' AND Estado='$Estado'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Nom_Tip_Mob']==$Nom_Tip_Mob AND $row['ID_H_O_D']==$ID_H_O_D AND $row['Estado']==$Estado){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            $sql = "INSERT INTO `Tipos_Mobiliarios_POS`( `Nom_Tip_Mob`,`Estado`,`Cod_Estado`,`Agregado_Por`,`Sistema`,`ID_H_O_D`) 
            VALUES ('$Nom_Tip_Mob','$Estado','$Cod_Estado','$Agregado_Por','$Sistema','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>