<?php
    include_once 'db_connection.php';

$Fk_Fondo=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FkFondo'])))); 
$Cantidad_Fondo=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Cantidad'])))); 
$Empleado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empleado'])))); 
$Sucursal=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal'])))); 
$Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Estatus'])))); 
$CodigoEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CodEstatus'])))); 
$Fecha_Apertura=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Fecha'])))); 
$Turno=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Turno'])))); 
$Asignacion=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Asignacion'])))); 
$D1000=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['BilleteMil'])))); 
$D500=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['BilleteQuinie'])))); 
$D200=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['BilleteCien'])))); 
$D50=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['BilleteCincuenta'])))); 
$D20=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['BilleteVeinte'])))); 
$D10=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaDiez'])))); 
$D5=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaCinco'])))); 
$D2=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaDos'])))); 
$D1=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaPeso'])))); 
$D50C=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaCincuenta'])))); 
$D20C=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaVeinte'])))); 
$D10C=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaDiezC'])))); 
$Valor_Total_Caja=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TotalCaja'])))); 
$Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema'])))); 
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));  
$MedicoEnturno=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['MedicoEnturno']))));  
$EnfermeroEnturno=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EnfermeroEnturno']))));  



//include database configuration file
    
    $sql = "SELECT Empleado,Sucursal,Estatus,Fecha_Apertura,ID_H_O_D,Cantidad_Fondo,Turno,Asignacion FROM Cajas_POS
     WHERE Empleado='$Empleado' AND Sucursal='$Sucursal' AND Estatus='$Estatus' AND Fecha_Apertura='$Fecha_Apertura' AND Cantidad_Fondo='$Cantidad_Fondo'AND Turno='$Turno' 
     AND Asignacion='$Asignacion'   AND ID_H_O_D='$ID_H_O_D'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Empleado']==$Empleado AND $row['Sucursal']==$Sucursal AND $row['Estatus']==$Estatus AND $row['Fecha_Apertura']==$Fecha_Apertura 
        AND $row['Cantidad_Fondo']==$Cantidad_Fondo AND $row['ID_H_O_D']==$ID_H_O_D AND $row['Turno']==$Turno AND $row['Asignacion']==$Asignacion ){				
            echo json_encode(array("statusCode"=>250));
          
        } 
       else{
            $sql = "INSERT INTO `Cajas_POS`( `Fk_Fondo`,`Cantidad_Fondo`,`Empleado`,`Sucursal`,`Estatus`,`CodigoEstatus`,`Fecha_Apertura`,`Turno`,`Asignacion`,`D1000`,`D500`,`D200`,`D100`,`D50`,
            `D20`,`D10`,`D5`,`D2`,`D1`,`D50C`,`D20C`,`D10C`,`Valor_Total_Caja`,`Sistema`,`ID_H_O_D`,`MedicoEnturno`,`EnfermeroEnturno`) 
            VALUES ('$Fk_Fondo','$Cantidad_Fondo','$Empleado','$Sucursal','$Estatus','$CodigoEstatus','$Fecha_Apertura','$Turno','$Asignacion','$D1000','$D500','$D200','$D100','$D50',
            '$D20','$D10','$D5','$D2','$D1','$D50C','$D20C','$D10C','$Valor_Total_Caja','$Sistema','$ID_H_O_D','$MedicoEnturno','$EnfermeroEnturno')";
        
            if (mysqli_query($conn, $sql)) {
               
                echo json_encode(array("statusCode"=>200));
             
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>