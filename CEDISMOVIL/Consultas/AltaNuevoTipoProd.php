<?php
    include_once 'db_connection.php';

$Nom_Tipo_Prod=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreTipoProd']))));
$Estado=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaEstPP']))));
$Cod_Estado=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaProdT']))));
$Agregado_Por=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioTP']))));
$Sistema=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaPP']))));
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaPP']))));    
//include database configuration file
    
    $sql = "SELECT Nom_Tipo_Prod,Estado,ID_H_O_D FROM TipProd_POS WHERE Nom_Tipo_Prod='$Nom_Tipo_Prod' 
    AND ID_H_O_D='$ID_H_O_D' AND Estado='$Estado'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Nom_Tipo_Prod']==$Nom_Tipo_Prod AND $row['ID_H_O_D']==$ID_H_O_D AND $row['Estado']==$Estado){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            $sql = "INSERT INTO `TipProd_POS`( `Nom_Tipo_Prod`,`Estado`,`Cod_Estado`,`Agregado_Por`,`Sistema`,`ID_H_O_D`) 
            VALUES ('$Nom_Tipo_Prod','$Estado','$Cod_Estado','$Agregado_Por','$Sistema','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>