<?php


    include_once 'db_connectionremote.php';

    

    
$Number_Empleado=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['documento']))));
$Nombre=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['nombre']))));
$Sucursal=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['sucursal']))));
$Area=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['puesto']))));



$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['empresa']))));

    //include database configuration file
    
    $sql = "SELECT Number_Empleado,Sucursal,Area,Tipo_Registro FROM Reloj_Checador WHERE Number_Empleado='$Number_Empleado' AND Sucursal='$Sucursal'
    AND Area='$Area' ";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Number_Empleado']==$Number_Empleado AND $row['Sucursal']==$Sucursal AND $row['Area']==$Area ){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            $sql = "INSERT INTO `Reloj_Checador`( `Number_Empleado`, `Nombre`, `Sucursal`, `Area`, `ID_H_O_D`) 
 VALUES ('$Number_Empleado', '$Nombre', '$Sucursal', '$Area','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
    
    
   
    

}
?>