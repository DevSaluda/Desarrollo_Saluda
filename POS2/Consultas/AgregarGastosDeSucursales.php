<?php
    include_once 'db_connection.php';

$Concepto_Categoria=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ConceptoGasto'])))); 
$Importe_Total=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Importe'])))); 
$Empleado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario'])))); 
$Fk_sucursal=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal'])))); 
$Fk_Caja=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Caja'])))); 
$Descripcion=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Descripcion'])))); 

$Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema'])))); 
$AgregadoPor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario'])))); 
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));   

//include database configuration file
    
    $sql = "SELECT Empleado,Fk_sucursal,ID_H_O_D,Importe_Total FROM Otros_Gastos_POS
     WHERE Empleado='$Empleado' AND Fk_sucursal='$Fk_sucursal'   AND Importe_Total='$Importe_Total'  AND ID_H_O_D='$ID_H_O_D'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Empleado']==$Empleado AND $row['Fk_sucursal']==$Fk_sucursal  AND  $row['Importe_Total']==$Importe_Total AND $row['ID_H_O_D']==$ID_H_O_D ){				
            echo json_encode(array("statusCode"=>250));
          
        } 
       else{
            $sql = "INSERT INTO `Otros_Gastos_POS`(`Concepto_Categoria`, `Importe_Total`, `Empleado`, `Fk_sucursal`, `Fk_Caja`, `Descripcion`, `Sistema`, `AgregadoPor`, `ID_H_O_D`) 
            VALUES ('$Concepto_Categoria', '$Importe_Total', '$Empleado', '$Fk_sucursal', '$Fk_Caja', '$Descripcion', '$Sistema', '$AgregadoPor', '$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
               
                echo json_encode(array("statusCode"=>200));
             
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>