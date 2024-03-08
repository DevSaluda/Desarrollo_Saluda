<?php
include_once 'db_connection.php';
$EstadoTraspaso="Generado";
$Folio_Prod_Stock=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['ID_Prod']))));
$ID_Prod_POS=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['ID_Prod']))));
$Cod_Barra =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['AsignaCodBarra']))));
$Nombre_Prod =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['AsignaNombreProd']))));
$Fk_sucursal =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalOrigen']))));
$Fk_Sucursal_Destino=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalDestino']))));
$Fk_SucDestino=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['VerdaderaSucursal']))));

$Precio_Venta =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['PrecioVenta']))));
$Precio_Compra =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['PrecioCompra']))));
$Total_traspaso =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Totaldecompra']))));
$TotalVenta=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['TotaldeVenta']))));
$Existencias_R =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['ExisteActual']))));
$Cantidad_Enviada=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['CanTraspaso']))));
$Existencias_D_envio=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['NewCantidadExistenciasR']))));
$FechaEntrega=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaAprox']))));

$TraspasoGeneradoPor=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['AgregaProductosBy']))));

$Tipo_Servicio =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['TipoServicio']))));
$Proveedor1=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['RevProvee1']))));
$Proveedor2=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['RevProvee2']))));
$Estatus=  $conn->real_escape_string(htmlentities(strip_tags(Trim($EstadoTraspaso))));
$AgregadoPor =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['AgregaProductosBy']))));
$ID_H_O_D =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaProductos']))));
//include database configuration file


    $sql = "INSERT INTO `Traspasos_generados`( `Folio_Prod_Stock`, `ID_Prod_POS`, `Cod_Barra`, `Nombre_Prod`, `Fk_sucursal`, `Fk_Sucursal_Destino`, `Fk_SucDestino` ,`Precio_Venta`, `Precio_Compra`, 
    `Total_traspaso`,`TotalVenta`, `Existencias_R`, `Cantidad_Enviada`, `Existencias_D_envio`, `FechaEntrega`,  `TraspasoGeneradoPor`, `TraspasoRecibidoPor`, `Tipo_Servicio`, 
    `Proveedor1`, `Proveedor2`, `Estatus`,`AgregadoPor`, `ID_H_O_D`) 
            VALUES ( '$Folio_Prod_Stock', '$ID_Prod_POS', '$Cod_Barra', '$Nombre_Prod', '$Fk_sucursal', '$Fk_Sucursal_Destino', '$Fk_SucDestino','$Precio_Venta', '$Precio_Compra', 
    '$Total_traspaso','$TotalVenta','$Existencias_R', '$Cantidad_Enviada', '$Existencias_D_envio', '$FechaEntrega',  '$TraspasoGeneradoPor', '$TraspasoRecibidoPor', '$Tipo_Servicio', 
    '$Proveedor1', '$Proveedor2', '$Estatus', '$AgregadoPor', '$ID_H_O_D')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);

