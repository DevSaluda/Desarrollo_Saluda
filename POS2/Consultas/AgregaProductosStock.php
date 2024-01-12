<?php
include_once 'db_connection.php';

$TipVigencia = 'Vigente';
$CodVig = 'background-color:#2BBB1D!important;';
$ID_Prod_POS=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['ID_Prod_Prod']))));
$Clave_adicional =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Clav']))));
$Cod_Barra =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['CodigosDeBarras']))));
$Nombre_Prod =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Nombre_Prod']))));
$Fk_sucursal =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursale']))));
$Precio_Venta =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['PrecioVen']))));
$Precio_C =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['PrecioCom']))));
$Max_Existencia =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Maximo']))));
$Min_Existencia =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Minimo']))));
$Existencias_R =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['IngresoCantidad']))));
$Lote =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['LoteProd']))));
$Fecha_Caducidad =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaCaducidad']))));
$Tipo =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Tipo']))));
$FkCategoria =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Categoria']))));
$FkMarca =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Marca']))));
$FkPresentacion =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Presentacion']))));
$Proveedor1=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['RevProvee1']))));
$Proveedor2=  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['RevProvee2']))));
$Estatus =  $conn->real_escape_string(htmlentities(strip_tags(Trim($TipVigencia))));
$CodigoEstatus =  $conn->real_escape_string(htmlentities(strip_tags(Trim($CodVig))));

$Sistema =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaProductos']))));
$AgregadoPor =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['AgregaProductosBy']))));
$ID_H_O_D =  $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaProductos']))));
//include database configuration file

$sql = "SELECT ID_Prod_POS,Clave_adicional,Cod_Barra FROM Stock_POS WHERE  ID_Prod_POS='$ID_Prod_POS' AND Clave_adicional='$Clave_adicional' AND  Cod_Barra='$Cod_Barra'  ";
$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);
//include database configuration file
if ($row['Clave_adicional'] == $Clave_adicional and $row['ID_Prod_POS'] == $ID_Prod_POS and $row['Cod_Barra'] == $Cod_Barra) {
    echo json_encode(array("statusCode" => 250));
} else {
    $sql = "INSERT INTO `Stock_POS`( `ID_Prod_POS`,`Clave_adicional`,`Cod_Barra`,`Nombre_Prod`,`Fk_sucursal`,`Precio_Venta`,`Precio_C`,`Max_Existencia`,`Min_Existencia`,`Existencias_R`,
    `Lote`,`Fecha_Caducidad`,`Tipo`,`FkCategoria`,`FkMarca`,`FkPresentacion`,`Proveedor1`,`Proveedor2`,`Estatus`,`CodigoEstatus`,`Sistema`,`AgregadoPor`,`AgregadoEl`,`ID_H_O_D`) 
            VALUES ('$ID_Prod_POS','$Clave_adicional','$Cod_Barra','$Nombre_Prod','$Fk_sucursal','$Precio_Venta','$Precio_C','$Max_Existencia','$Min_Existencia','$Existencias_R',
    '$Lote','$Fecha_Caducidad','$Tipo','$FkCategoria','$FkMarca','$FkPresentacion','$Proveedor1','$Proveedor2','$Estatus','$CodigoEstatus','$Sistema','$AgregadoPor','$AgregadoEl','$ID_H_O_D')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
