<?php
    include_once 'db_connection.php';
$Espera="En espera";
$Colores="background-color:#4285f4 !important";
$Nombre_RazonSocial	=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Nombres'])))); 
$RFC=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['RFC'])))); 
$Direccion=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Direccion'])))); 
$Uso_CFDI=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CFDI'])))); 
$Telefono=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Tel'])))); 
$Fk_Ticket=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FKTicket'])))); 
$Fk_Sucursal=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalFac'])))); 
$Correo=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Correo'])))); 
$Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($Espera)))); 
$CodigoEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($Colores)))); 
$Agrega=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario'])))); 
$Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema'])))); 
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));   

//include database configuration file
    
    $sql = "SELECT Nombre_RazonSocial,Direccion,Uso_CFDI,Estatus,Fk_Sucursal,Fk_Ticket,ID_H_O_D,RFC FROM Data_Facturacion_POS
     WHERE Direccion='$Direccion' AND Uso_CFDI='$Uso_CFDI' AND Estatus='$Estatus' AND Fk_Sucursal='$Fk_Sucursal' AND RFC='$RFC'  AND ID_H_O_D='$ID_H_O_D'
     AND Fk_Sucursal='$Fk_Sucursal'  AND Fk_Ticket='$Fk_Ticket'  AND Nombre_RazonSocial='$Nombre_RazonSocial'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Direccion']==$Direccion AND $row['Uso_CFDI']==$Uso_CFDI AND $row['Estatus']==$Estatus AND $row['Fk_Sucursal']==$Fk_Sucursal 
        AND $row['RFC']==$RFC AND $row['ID_H_O_D']==$ID_H_O_D AND $row['Fk_Sucursal']==$Fk_Sucursal AND $row['Fk_Ticket']==$Fk_Ticket AND $row['Nombre_RazonSocial']==$Nombre_RazonSocial ){				
            echo json_encode(array("statusCode"=>250));
          
        } 
       else{
            $sql = "INSERT INTO `Data_Facturacion_POS`( `Nombre_RazonSocial`, `RFC`, `Direccion`, `Uso_CFDI`, `Telefono`, `Fk_Ticket`, `Fk_Sucursal`, `Correo`, `Estatus`, `CodigoEstatus`, `Agrega`, `Sistema`, `ID_H_O_D`) 
            VALUES ('$Nombre_RazonSocial','$RFC','$Direccion','$Uso_CFDI','$Telefono','$Fk_Ticket','$Fk_Sucursal','$Correo','$Estatus','$CodigoEstatus','$Agrega','$Sistema','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
               
                echo json_encode(array("statusCode"=>200));
             
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>