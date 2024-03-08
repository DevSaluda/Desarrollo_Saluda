<?php

include_once 'db_connection.php';
    
$Nom_Cat =  $conn -> real_escape_string(htmlentities(strip_tags(Trim(ucwords(strtolower($_POST['nombrecategoria']))))));
$Estado =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['vigenciaest']))));
$Cod_Estado =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['vigencia']))));
$Agregado_Por =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['usuario']))));
$Sistema =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['sistema']))));
$ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['empresa']))));

    //include database configuration file
    
    //insert form data in the database
    $sql = "SELECT Nom_Cat,ID_H_O_D FROM Categorias_POS WHERE Nom_Cat='$Nom_Cat' AND ID_H_O_D='$ID_H_O_D'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);	
    //include database configuration file
    if($row['Nom_Cat']==$Nom_Cat AND $row['ID_H_O_D']==$ID_H_O_D ){				
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
    
		$sql = "INSERT INTO `Categorias_POS`( `Nom_Cat`,`Estado`,`Cod_Estado`,`Agregado_Por`,`Sistema`,`ID_H_O_D`) 
		VALUES ('$Nom_Cat','$Estado','$Cod_Estado','$Agregado_Por','$Sistema','$ID_H_O_D')";
	
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




    
   
