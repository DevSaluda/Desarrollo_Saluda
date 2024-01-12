<?php
    include_once 'db_connection.php';

$Cod_Mobiliario=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CodigoAsignado']))));
$Nombre=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreEquipoAS']))));
$Tipo=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TipoAS']))));
$Cantidad_Asignada=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CanAsi']))));
$Asigno=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioEnvia']))));

$Fk_sucursal=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalAS']))));  

$Enviado_El=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FecEnvio']))));  
$Recibio=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['']))));  
$Estado=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EstadoAs']))));  
$Cod_Estado=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CodEstadoAs']))));  
$Agregado_Por=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioAS']))));  
$Sistema=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaAs']))));  
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaAs']))));  

//include database configuration file
    
    $sql = "SELECT Cod_Mobiliario,Nombre,Fk_sucursal,ID_H_O_D FROM Mobiliario_Asignado WHERE Cod_Mobiliario='$Cod_Mobiliario' AND 
     Fk_sucursal='$Fk_sucursal' AND Nombre='$Nombre' AND ID_H_O_D='$ID_H_O_D'";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);	
        //include database configuration file
        if($row['Cod_Mobiliario']==$Cod_Mobiliario AND $row['Fk_sucursal']==$Fk_sucursal AND $row['Nombre']==$Nombre AND $row['ID_H_O_D']==$ID_H_O_D){				
            echo json_encode(array("statusCode"=>250));
          
        } 
        else{
            $sql = "INSERT INTO `Mobiliario_Asignado`( `Cod_Mobiliario`,`Nombre`,`Tipo`,`Cantidad_Asignada`,`Asigno`,`Fk_sucursal`,`Enviado_El`,`Recibio`,`Estado`,`Cod_Estado`,
            `Agregado_Por`,`Sistema`,`ID_H_O_D`) 
            VALUES ('$Cod_Mobiliario','$Nombre','$Tipo','$Cantidad_Asignada','$Asigno','$Fk_sucursal','$Enviado_El','$Recibio','$Estado','$Cod_Estado',
            '$Agregado_Por','$Sistema','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
            mysqli_close($conn);
        }

?>