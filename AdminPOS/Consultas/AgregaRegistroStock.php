<?php
include_once 'db_connection.php';
$ID_Prod_POS=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ACT_ID_Prod']))));
       
$Lote=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Loteeee']))));
$Fecha_Caducidad=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['fechacadd']))));
$AgregadoPor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AgregaProductosBy']))));
$Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaProductos']))));
$Existencias_R=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NuevaExistencia']))));
$ExistenciaPrev=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ExistenciaPrev']))));
$Recibido=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Recibio']))));
$Fk_sucursal=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['StockActualiza']))));
$ID_H_O_D=$conn -> real_escape_string(htmlentities(strip_tags(Trim("Saluda"))));
$Factura=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FacturasNumber']))));
$Precio_compra=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['preciocompraAguardar']))));
$Total_Factura=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TotalDeFacturaPorGuardar']))));
    $sql = "INSERT INTO `Stock_registrosNuevos`( `ID_Prod_POS`, `Fk_sucursal`, `Existencias_R`, `ExistenciaPrev`, `Recibido`, `Lote`, `Fecha_Caducidad`, `AgregadoPor`,`ID_H_O_D`,`Factura`) VALUES
     ('$ID_Prod_POS', '$Fk_sucursal', '$Existencias_R', '$ExistenciaPrev', '$Recibido','$Lote','$Fecha_Caducidad', '$AgregadoPor','$ID_H_O_D','$Factura')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);

