
<?php
    include_once 'db_connection.php';

$Nombre_Promo=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombrePromo']))));
$CantidadADescontar=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CantidadDesc']))));
$Fk_Tratamiento=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Tratamiento']))));

$Estatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaEstPromo']))));
$CodigoEstatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaPromo']))));
$Agrega=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioPromo']))));
$Sistema=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaPromo']))));

$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaPromo']))));    
//include database configuration file
    
    $sql = "SELECT Nombre_Promo,CantidadADescontar,Fk_Tratamiento,Estatus,ID_H_O_D FROM Promos_Credit_POS WHERE Nombre_Promo='$Nombre_Promo' AND 
     ID_H_O_D='$ID_H_O_D' AND Estatus='$Estatus' AND Fk_Tratamiento='$Fk_Tratamiento' AND CantidadADescontar='$CantidadADescontar'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Nombre_Promo']==$Nombre_Promo AND $row['CantidadADescontar']==$CantidadADescontar AND $row['Fk_Tratamiento']==$Fk_Tratamiento AND $row['Estatus']==$Estatus AND  $row['ID_H_O_D']==$ID_H_O_D){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            echo "Tratamiento recibido: " . $Fk_Tratamiento . "<br>";


            $sql = "INSERT INTO `Promos_Credit_POS`( `Nombre_Promo`,`CantidadADescontar`,`Fk_Tratamiento`,`Estatus`,`CodigoEstatus`,`Agrega`,`Sistema`,`ID_H_O_D`) 
            VALUES ('$Nombre_Promo','$CantidadADescontar','$Fk_Tratamiento','$Estatus','$CodigoEstatus','$Agrega','$Sistema','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>