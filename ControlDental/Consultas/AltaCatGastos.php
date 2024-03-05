<?php

include_once 'db_connection.php';
    
$Nom_Cat_Gasto =  $conn -> real_escape_string(htmlentities(strip_tags(Trim(ucwords(strtolower($_POST['NombreCategoria']))))));
$Estado =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaEst']))));
$Cod_Estado =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Vigencia']))));
$Agregado_Por =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));
$Sistema =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
$ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));

    //include database configuration file
    
    //insert form data in the database
    $sql = "SELECT Nom_Cat_Gasto,ID_H_O_D FROM Categorias_Gastos_POS WHERE Nom_Cat_Gasto='$Nom_Cat_Gasto' AND ID_H_O_D='$ID_H_O_D'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);	
    //include database configuration file
    if($row['Nom_Cat_Gasto']==$Nom_Cat_Gasto AND $row['ID_H_O_D']==$ID_H_O_D ){				
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
    
		$sql = "INSERT INTO `Categorias_Gastos_POS`( `Nom_Cat_Gasto`,`Estado`,`Cod_Estado`,`Agregado_Por`,`Sistema`,`ID_H_O_D`) 
		VALUES ('$Nom_Cat_Gasto','$Estado','$Cod_Estado','$Agregado_Por','$Sistema','$ID_H_O_D')";
	
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




    
   
