<?php

    include_once 'db_connection.php';
if(!empty($_POST['name']) || !empty($_FILES['file']['name'])){
    $uploadedFile = '';
    if(!empty($_FILES["file"]["type"])){
        $fileName = time().'_'.$_FILES['file']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);
        if((($_FILES["hard_file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/png")) && in_array($file_extension, $valid_extensions)){
            $sourcePath = $_FILES['file']['tmp_name'];
            $targetPath = "../../Perfiles/$fileName";
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
            }
        }
    }

    
$Nombre_Apellidos=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['nombres']))));
$Fk_Usuario=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['usuario']))));
$Fecha_Nacimiento=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['fecha']))));
$Correo_Electronico=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['correo']))));
$Telefono=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['telefono']))));
$AgregadoPor=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['agrega']))));
$Password=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['password']))));
$Fk_Sucursal=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['sucursal']))));
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['empresa']))));
$Estatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaInicio']))));
$ColorEstatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['vigencia']))));
    //include database configuration file
    
    $sql = "SELECT Nombre_Apellidos,Fk_Usuario,Correo_Electronico,ID_H_O_D,Fk_Sucursal FROM  Personal_Enfermeria WHERE Nombre_Apellidos='$Nombre_Apellidos' AND ID_H_O_D='$ID_H_O_D'
    AND Fk_Usuario='$Fk_Usuario'AND Correo_Electronico='$Correo_Electronico' AND Fk_Sucursal='$Fk_Sucursal'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Nombre_Apellidos']==$Nombre_Apellidos AND $row['ID_H_O_D']==$ID_H_O_D AND $row['Fk_Usuario']==$Fk_Usuario AND $row['Correo_Electronico']==$Correo_Electronico
        AND $row['Fk_Sucursal']==$Fk_Sucursal){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            $sql = "INSERT INTO `Personal_Enfermeria`( `Nombre_Apellidos`,`Password`,`file_name`,`Fk_Usuario`,`Fecha_Nacimiento`,`Correo_Electronico`,`Telefono`,`AgregadoPor`,`Fk_Sucursal`,`ID_H_O_D`,`Estatus`,`ColorEstatus`) 
            VALUES ('$Nombre_Apellidos','$Password','$uploadedFile','$Fk_Usuario','$Fecha_Nacimiento','$Correo_Electronico','$Telefono','$AgregadoPor','$Fk_Sucursal','$ID_H_O_D','$Estatus','$ColorEstatus')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
    
    
   
    
}
}
?>