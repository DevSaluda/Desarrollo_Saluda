<?php
    include_once 'db_connection.php';

$Folio_Prod_Stock=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FolioProd'])))); 
$ID_Prod_POS=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ProdId'])))); 
$Clave_adicional=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ClavAd'])))); 
$Cod_Barra=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CodBarra']))));
$Nombre_Prod=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NameProd']))));
$Fk_sucursal=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalBase']))));
$Sucursal_Destino=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalDestino']))));
$Fk_Sucursal_Destino=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalNombreDestino']))));
$Existencias_R=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Existencia']))));
$Cantidad_Solicitada=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CantidadSolicitada']))));
$Motivo_Solicitud=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MotSol']))));
$SolicitadoPor	=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));
$Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Estatus']))));
$CodigoEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Codigo']))));
$Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema'])))); 
$AgregadoPor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));   

//include database configuration file
    
    $sql = "SELECT Folio_Prod_Stock,Cod_Barra,Fk_sucursal,Sucursal_Destino,Cantidad_Solicitada,Motivo_Solicitud,AgregadoPor,ID_H_O_D FROM Solicitudes_Traspasos
     WHERE Folio_Prod_Stock='$Folio_Prod_Stock' AND Cod_Barra='$Cod_Barra' AND Fk_sucursal='$Fk_sucursal' AND Sucursal_Destino='$Sucursal_Destino' AND Cantidad_Solicitada='$Cantidad_Solicitada' AND
     Motivo_Solicitud='$Motivo_Solicitud' AND AgregadoPor='$AgregadoPor' AND ID_H_O_D='$ID_H_O_D'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Folio_Prod_Stock']==$Folio_Prod_Stock AND $row['Cod_Barra']==$Cod_Barra AND $row['Fk_sucursal']==$Fk_sucursal AND $row['Sucursal_Destino']==$Sucursal_Destino 
        AND $row['Cantidad_Solicitada']==$Cantidad_Solicitada AND $row['Motivo_Solicitud']==$Motivo_Solicitud AND $row['AgregadoPor']==$AgregadoPor AND $row['ID_H_O_D']==$ID_H_O_D ){				
            echo json_encode(array("statusCode"=>250));
          
        } 
       else{
            $sql = "INSERT INTO `Solicitudes_Traspasos`(`Folio_Prod_Stock`, `ID_Prod_POS`, `Clave_adicional`, `Cod_Barra`, `Nombre_Prod`, `Fk_sucursal`,
             `Sucursal_Destino`,`Fk_Sucursal_Destino`, `Existencias_R`, `Cantidad_Solicitada`, `Motivo_Solicitud`, `SolicitadoPor`, `Estatus`, `CodigoEstatus`, `Sistema`, `AgregadoPor`, `ID_H_O_D`) 
            VALUES ('$Folio_Prod_Stock','$ID_Prod_POS','$Clave_adicional','$Cod_Barra','$Nombre_Prod','$Fk_sucursal',
             '$Sucursal_Destino','$Fk_Sucursal_Destino' ,'$Existencias_R', '$Cantidad_Solicitada', '$Motivo_Solicitud','$SolicitadoPor', '$Estatus', '$CodigoEstatus', '$Sistema','$AgregadoPor','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
               
                echo json_encode(array("statusCode"=>200));
             
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>