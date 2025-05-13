
<?php

include_once 'db_connection.php';
$EstatusVigencia="Disponible";

$Sistemaa="Agenda de citas";
$Nombre_Especialidad =  $conn -> real_escape_string(htmlentities(strip_tags(Trim(ucwords(strtolower($_POST['Especialidad']))))));
$Fk_Sucursal = $conn -> real_escape_string(htmlentities(strip_tags(Trim(ucwords(strtolower($_POST['Sucursal']))))));
$ID_H_O_D= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));
$Estatus_Especialidad= $conn -> real_escape_string(htmlentities(strip_tags(Trim($EstatusVigencia))));	
$AgregadoPor	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));
$Sistema	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($Sistemaa))));


$sql = "SELECT Nombre_Especialidad,ID_H_O_D,Fk_Sucursal FROM Especialidades_Express WHERE Nombre_Especialidad='$Nombre_Especialidad' AND Fk_Sucursal='$Fk_Sucursal'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);	
    //include database configuration file
    if($row['Nombre_Especialidad']==$Nombre_Especialidad AND $row['ID_H_O_D']==$ID_H_O_D AND $row['Fk_Sucursal']==$Fk_Sucursal){				
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
    
$sql = "INSERT INTO `Especialidades_Express`( `Nombre_Especialidad`,`Fk_Sucursal`,`ID_H_O_D`,`Estatus_Especialidad`,`AgregadoPor`,`Sistema`) 
VALUES ('$Nombre_Especialidad','$Fk_Sucursal','$ID_H_O_D','$Estatus_Especialidad','$AgregadoPor','$Sistema')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
}


   

    mysqli_close($conn);

?>



