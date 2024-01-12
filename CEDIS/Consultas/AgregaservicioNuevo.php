<?php

include_once 'db_connection.php';
    
$Nom_Serv =  $conn -> real_escape_string(htmlentities(strip_tags(Trim(ucwords(strtolower($_POST['Nombreservicio']))))));
$Estado =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaServ']))));
$Cod_Estado =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaServicio']))));
$Agregado_Por =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioServ']))));
$Sistema =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaServ']))));
$ID_H_O_D =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaServ']))));

    //include database configuration file
    
    //insert form data in the database
    $sql = "SELECT Nom_Serv,ID_H_O_D FROM Servicios_POS WHERE Nom_Serv='$Nom_Serv' AND ID_H_O_D='$ID_H_O_D'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);	
    //include database configuration file
    if($row['Nom_Serv']==$Nom_Serv AND $row['ID_H_O_D']==$ID_H_O_D ){				
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
    
		$sql = "INSERT INTO `Servicios_POS`( `Nom_Serv`,`Estado`,`Cod_Estado`,`Agregado_Por`,`Sistema`,`ID_H_O_D`) 
		VALUES ('$Nom_Serv','$Estado','$Cod_Estado','$Agregado_Por','$Sistema','$ID_H_O_D')";
	
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);
   

    
}
?>




    
   
