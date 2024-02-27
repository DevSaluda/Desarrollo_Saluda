
<?php
if(!empty($_POST['medico'])  || !empty($_POST['costo'])|| !empty($_POST['empresa'])|| !empty($_POST['usuario'])){
include_once 'db_connection.php';
$EstatusVigencia="Vigente";
$CodigodeEstatus="background-color:#b87455 !important";
$Costo_Especialista =  $conn -> real_escape_string(htmlentities(strip_tags($_POST['costo'])));
$FK_Especialista =  $conn -> real_escape_string(htmlentities(strip_tags($_POST['medico'])));
$ID_H_O_D	= $conn -> real_escape_string(htmlentities(strip_tags($_POST['empresa'])));

$Estatus	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($EstatusVigencia))));	
$Codigocolor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($CodigodeEstatus))));
$AgregadoPor	= $conn -> real_escape_string(htmlentities(strip_tags($_POST['usuario'])));

$sql = "SELECT Costo_Especialista,FK_Especialista FROM Costos_EspecialistasV2 WHERE Costo_Especialista='$Costo_Especialista' AND FK_Especialista='$FK_Especialista'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);	
    //include database configuration file
    if($row['Costo_Especialista']==$Costo_Especialista and $row['FK_Especialista']=="$FK_Especialista"){				
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
    
$sql = "INSERT INTO `Costos_EspecialistasV2`( `Costo_Especialista`,`ID_H_O_D`,`FK_Especialista`,`Estatus`,`Codigocolor`,`AgregadoPor`) 
VALUES ('$Costo_Especialista','$ID_H_O_D','$FK_Especialista','$Estatus','$Codigocolor','$AgregadoPor')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
}


   

    mysqli_close($conn);
}
?>

