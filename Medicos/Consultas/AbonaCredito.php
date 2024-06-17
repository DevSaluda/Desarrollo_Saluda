<?php
    include_once 'db_connection.php';

$Fk_Folio_Credito=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FolioCred']))));
$Fk_tipo_Credi=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FolioTipocred']))));
$Nombre_Cred=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Titular']))));
$Cant_Apertura=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SaldoActual']))));
$Cant_Abono=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Abono']))));
$Fecha_Abono=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaAbono']))));
$Saldo= $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SaldoNuevo']))));
$Fk_Sucursal=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));

$Estatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Estatus']))));
$CodigoEstatus=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Codigo']))));
$Agrega=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));
$Sistema=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));   

//include database configuration file
    
    $sql = "SELECT Fk_Folio_Credito,Fk_tipo_Credi,Nombre_Cred,Cant_Apertura,Cant_Abono,Fecha_Abono,Saldo,Fk_Sucursal,Agrega,Sistema,ID_H_O_D FROM AbonoCreditos_POS
     WHERE Fk_Folio_Credito='$Fk_Folio_Credito' AND Fk_tipo_Credi='$Fk_tipo_Credi' AND Nombre_Cred='$Nombre_Cred' AND Cant_Apertura='$Cant_Apertura' AND Cant_Abono='$Cant_Abono' AND Fecha_Abono='$Fecha_Abono'
     AND Saldo='$Saldo' AND Fk_Sucursal='$Fk_Sucursal' AND Agrega='$Agrega' AND Sistema='$Sistema' AND Cant_Apertura='$Cant_Apertura' AND ID_H_O_D='$ID_H_O_D'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Fk_Folio_Credito']==$Fk_Folio_Credito AND $row['Fk_tipo_Credi']==$Fk_tipo_Credi AND $row['Nombre_Cred']==$Nombre_Cred AND $row['Cant_Apertura']==$Cant_Apertura 
        AND $row['Cant_Abono']==$Cant_Abono AND $row['Fecha_Abono']==$Fecha_Abono AND $row['Saldo']==$Saldo AND $row['Fk_Sucursal']==$Fk_Sucursal AND $row['Agrega']==$Agrega
        AND $row['Sistema']==$Sistema AND $row['ID_H_O_D']==$ID_H_O_D ){				
            echo json_encode(array("statusCode"=>250));
          
        } 
       else{
            $sql = "INSERT INTO `AbonoCreditos_POS`( `Fk_Folio_Credito`,`Fk_tipo_Credi`,`Nombre_Cred`,`Cant_Apertura`,`Cant_Abono`,
            `Fecha_Abono`,`Saldo`,`Fk_Sucursal`,`Estatus`,`CodigoEstatus`,`Agrega`,`Sistema`,`ID_H_O_D`) 
            VALUES ('$Fk_Folio_Credito','$Fk_tipo_Credi','$Nombre_Cred','$Cant_Apertura','$Cant_Abono',
            '$Fecha_Abono','$Saldo','$Fk_Sucursal','$Estatus','$CodigoEstatus','$Agrega','$Sistema','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
               
                echo json_encode(array("statusCode"=>200));
             
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>