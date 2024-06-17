<?php

include_once 'db_connection.php';
    
$Nom_Com =  $conn -> real_escape_string(htmlentities(strip_tags(Trim(ucwords(strtolower($_POST['NombreComponente']))))));

$AgregadoPor =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));

$ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));

    //include database configuration file
    
    //insert form data in the database
    $sql = "SELECT Nom_Com FROM ComponentesActivos WHERE Nom_Com='$Nom_Com'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);	
    //include database configuration file
    if($row['Nom_Com']==$Nom_Com ){				
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
    
        $sql = "INSERT INTO `ComponentesActivos`( `Nom_Com`,`Agregado_Por`,`ID_H_O_D`) 
		VALUES ('$Nom_Com','$Agregado_Por','$ID_H_O_D')";
	
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);
   
   

}
?>




    
   
