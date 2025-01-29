<?php
    include_once 'db_connection.php';

    
    $ID_Prod_POS=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ID_PROD'])))); 
    $Identificador_tipo =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['IDentificador'])))); 
    $Turno =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Turno'])))); 
    $Folio_Sucursal =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TicketVal2'])))); 
    $Folio_Ticket =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TicketVal'])))); 
    $Clave_adicional =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ClavAd'])))); 
    $Cod_Barra =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CodBarra'])))); 
    $Nombre_Prod =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreProducto'])))); 
    $Cantidad_Venta=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CantidadVenta'])))); 
    $Fk_sucursal =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalesS'])))); 
    $Importe =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TotalVenta'])))); 
    $Fk_Caja=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CajaAsignada'])))); 
    $Lote=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Lote'])))); 
    $Sistema =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaCaja'])))); 
    $AgregadoPor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioCaja'])))); 
    $ID_H_O_D=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaCaja'])))); 

    $Fecha=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Fecha'])))); 

    $Cliente=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Cliente'])))); 
    $Total_Venta =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TotalVenta'])))); 
    $Total_VentaG=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TotalVenta'])))); 
            $sql = "INSERT INTO `Ventas_POS`(`ID_Prod_POS`,`Identificador_tipo`,`Turno`,`FolioSucursal`,`Folio_Ticket`,`Clave_adicional`,`Cod_Barra`,`Nombre_Prod`,`Cantidad_Venta`,`Fk_sucursal`,`Total_Venta`,`Importe`,`Total_VentaG`,`Cliente`,`Fecha_venta`,`Fk_Caja`,`Lote`,
            `Motivo_Cancelacion`,`Estatus`,`Sistema`,`AgregadoPor`,`ID_H_O_D`) 
            VALUES ('$ID_Prod_POS','$Identificador_tipo','$Turno','$Folio_Sucursal','$Folio_Ticket','$Clave_adicional','$Cod_Barra','$Nombre_Prod','$Cantidad_Venta',
             '$Fk_sucursal','$Total_Venta','$Importe','$Total_VentaG','$Cliente','$Fecha','$Fk_Caja', '$Lote','$Motivo_Cancelacion','$Estatus','$Sistema','$AgregadoPor','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
               
                echo json_encode(array("statusCode"=>800));
             
            } 
            else {
                echo json_encode(array("statusCode"=>801));
            }
            mysqli_close($conn);
        

?>