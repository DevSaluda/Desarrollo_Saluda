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
            $targetPath = "../../FotosMedidores/$fileName";
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
            }
        }
    }

$Registro_combustible=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['RegistroCombustible']))));
 $Fecha_registro=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Fecha'])))); 
 $Sucursal=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));
 $Comentario=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Comentario']))));
 $Registro=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Registro']))));
 $ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));
 $Tipo_Veiculo=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Tipo_Veiculo']))));

 //insert form data in the database
 $sql = "SELECT Registro_combustible,Fecha_registro,Registro FROM Registros_Combustibles WHERE Registro_combustible='$Registro_combustible' AND 
 Fecha_registro='$Fecha_registro' AND Registro='$Registro' ";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);  
    //include database configuration file
    if($row['Fecha_registro']==$Fecha_registro AND $row['Registro_combustible']==$Registro_combustible AND $row['Registro']==$Registro ){               
        echo json_encode(array("statusCode"=>250));
      
    } 
    else{
 
   
    
        $sql = "INSERT INTO `Registros_Combustibles`(`Registro_combustible`, `Fecha_registro`, `Sucursal`, `Comentario`, `Registro`, `ID_H_O_D`,`file_name`,`Tipo_Veiculo`) 
        VALUES ( '$Registro_combustible', '$Fecha_registro', '$Sucursal', '$Comentario', '$Registro', '$ID_H_O_D','$uploadedFile',    '$Tipo_Veiculo')";
    
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
        mysqli_close($conn);
   

    mysqli_close($conn);
    }
}
?>

