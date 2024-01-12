<?php

include_once 'db_connection.php';
    
$Nom_Marca =  $conn -> real_escape_string(htmlentities(strip_tags(Trim(ucwords(strtolower($_POST['nombremarca']))))));
$Estado =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['vigenciaestm']))));
$Cod_Estado =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['vigenciamarcas']))));
$Agregado_Por =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['usuariom']))));
$Sistema =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['sistemam']))));
$ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['empresam']))));

    //include database configuration file
    
    //insert form data in the database
    $sql = "SELECT Nom_Marca,ID_H_O_D FROM Marcas_POS WHERE Nom_Marca='$Nom_Marca' AND ID_H_O_D='$ID_H_O_D'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);	
    //include database configuration file
    if($row['Nom_Marca']==$Nom_Marca AND $row['ID_H_O_D']==$ID_H_O_D ){				
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
    
		$sql = "INSERT INTO `Marcas_POS`( `Nom_Marca`,`Estado`,`Cod_Estado`,`Agregado_Por`,`Sistema`,`ID_H_O_D`) 
		VALUES ('$Nom_Marca','$Estado','$Cod_Estado','$Agregado_Por','$Sistema','$ID_H_O_D')";
	
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




    
   
