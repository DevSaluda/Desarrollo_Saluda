<?php

include_once 'db_connection.php';
    
$Nom_Presentacion =  $conn -> real_escape_string(htmlentities(strip_tags(Trim(ucwords(strtolower($_POST['nombrepresentacion']))))));
$Siglas =  $conn -> real_escape_string(htmlentities(strip_tags(Trim(ucwords(strtolower($_POST['siglas']))))));
$Estado =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['vigenciaestp']))));
$Cod_Estado =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['vigenciapresentacion']))));
$Agregado_Por =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['usuariop']))));
$Sistema =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['sistemap']))));
$ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['empresap']))));

    //include database configuration file
    
    //insert form data in the database
    $sql = "SELECT Nom_Presentacion,ID_H_O_D FROM Presentacion_Prod_POS WHERE Nom_Presentacion='$Nom_Presentacion' AND ID_H_O_D='$ID_H_O_D'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);	
    //include database configuration file
    if($row['Nom_Presentacion']==$Nom_Presentacion AND $row['ID_H_O_D']==$ID_H_O_D ){				
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
    
		$sql = "INSERT INTO `Presentacion_Prod_POS`( `Nom_Presentacion`,`Siglas`,`Estado`,`Cod_Estado`,`Agregado_Por`,`Sistema`,`ID_H_O_D`) 
		VALUES ('$Nom_Presentacion','$Siglas','$Estado','$Cod_Estado','$Agregado_Por','$Sistema','$ID_H_O_D')";
	
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




    
   
