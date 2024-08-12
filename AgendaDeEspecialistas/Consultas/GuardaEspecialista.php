
<?php

include_once 'db_connection.php';
$EstatusVigencia="Disponible";

$Nombre_Apellidos =  $conn -> real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['NombreApellidos']))))));
$Correo_Electronico =  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Correo']))));
$Telefono = $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['Telefono']))));
$Especialidad_Express= $conn -> real_escape_string(htmlentities(strip_tags(trim($_POST['EspecialidadSuc']))));
$ID_H_O_D= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));
$Estatus= $conn -> real_escape_string(htmlentities(strip_tags(Trim($EstatusVigencia))));	
$AgregadoPor	= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));


$sql = "SELECT Nombre_Apellidos,Correo_Electronico,Especialidad_Express,Telefono FROM Personal_Medico_Express WHERE Nombre_Apellidos='$Nombre_Apellidos'  AND Especialidad_Express='$Especialidad_Express' AND 
Correo_Electronico='$Correo_Electronico'AND Telefono='$Telefono'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);	
    //include database configuration file
    if($row['Nombre_Apellidos']==$Nombre_Apellidos and $row['Especialidad']=="$Especialidad"){				
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
    
$sql = "INSERT INTO `Personal_Medico_Express`(`Nombre_Apellidos`, `Correo_Electronico`, `Telefono`, `Especialidad_Express`, `ID_H_O_D`, `Estatus`, `AgregadoPor`) 
VALUES ('$Nombre_Apellidos', '$Correo_Electronico', '$Telefono', '$Especialidad_Express', '$ID_H_O_D', '$Estatus', '$AgregadoPor')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
}


   

    mysqli_close($conn);

?>





