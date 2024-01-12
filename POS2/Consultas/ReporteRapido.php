<?php

include_once 'db_connection.php';
    
$Descripcion =  $conn -> real_escape_string(htmlentities(strip_tags(Trim(ucwords(strtolower($_POST['ReporteDescribe']))))));
$Reporto =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));
$Fk_Sucursal =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));
$Sistema =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
$ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));

    //include database configuration file
    
    //insert form data in the database
    $sql = "SELECT Descripcion,ID_H_O_D FROM Incidencias_Express WHERE Descripcion='$Descripcion' AND ID_H_O_D='$ID_H_O_D'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);	
    //include database configuration file
    if($row['Descripcion']==$Descripcion AND $row['ID_H_O_D']==$ID_H_O_D ){				
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
    
		$sql = "INSERT INTO `Incidencias_Express`( `Descripcion`,`Reporto`,`Fk_Sucursal`,`Sistema`,`ID_H_O_D`) 
		VALUES ('$Descripcion','$Reporto','$Fk_Sucursal','$Sistema','$ID_H_O_D')";
	
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);
   

}
?>




    
   
