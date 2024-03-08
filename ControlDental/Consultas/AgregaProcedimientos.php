<?php

include_once 'db_connection.php';
    
$Codigo_Procedimiento =  $conn -> real_escape_string(htmlentities(strip_tags(Trim(ucwords(strtolower($_POST['CodigoProcedimiento']))))));
$Nombre_Procedimiento =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreProcedimiento']))));
$Costo_Procedimiento=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CostoProcedimiento']))));
$AgregadoPor =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));

$ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));

    //include database configuration file
    
    //insert form data in the database
    $sql = "SELECT Codigo_Procedimiento,Nombre_Procedimiento,ID_H_O_D FROM Procedimientos_Medicos WHERE Codigo_Procedimiento='$Codigo_Procedimiento' AND 
    Nombre_Procedimiento = '$Nombre_Procedimiento' AND ID_H_O_D='$ID_H_O_D'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);	
    //include database configuration file
    if($row['Codigo_Procedimiento']==$Codigo_Procedimiento AND  $row['Nombre_Procedimiento']==$Nombre_Procedimiento AND $row['ID_H_O_D']==$ID_H_O_D ){				
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
    
		$sql = "INSERT INTO `Procedimientos_Medicos`( `Codigo_Procedimiento`,`Nombre_Procedimiento`,`Costo_Procedimiento`,`AgregadoPor`,`ID_H_O_D`) 
		VALUES ('$Codigo_Procedimiento','$Nombre_Procedimiento','$Costo_Procedimiento','$AgregadoPor','$ID_H_O_D')";
	
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);
   

    mysqli_close($conn);
}
?>




    
   
