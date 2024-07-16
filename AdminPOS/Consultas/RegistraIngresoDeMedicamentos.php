<?php
include_once 'db_connection.php';

$ID_Prod_POS = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['IdBasedatos']))));
$Cod_Barras = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['CodBarras']))));
$Lote = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Loteeee']))));
$Fecha_Caducidad = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['fechacadd']))));
$AgregadoPor = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['AgregoElVendedor']))));
$Sistema = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Sistema']))));
$Existencias_R = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Diferencia']))));
$ExistenciaPrev = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['StockActual']))));
$Recibido = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Contabilizado']))));
$Fk_sucursal = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Fk_sucursal']))));
$ID_H_O_D = $conn->real_escape_string(htmlentities(strip_tags(trim("Saluda"))));
$Factura = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['FacturaNumber']))));
$Precio_compra = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['preciocompraAguardar']))));
$Total_Factura = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['CostototalFactura']))));

$sql = "INSERT INTO Stock_registrosNuevos (`ID_Prod_POS`,`Cod_Barras`, `Fk_sucursal`, `Existencias_R`, `ExistenciaPrev`, `Recibido`, `Lote`, `Fecha_Caducidad`, `AgregadoPor`, `ID_H_O_D`, `Factura`, `Precio_compra`, `Total_Factura`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

$stmt = mysqli_prepare($conn, $sql);

$response = array();

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssssssssssss", $ID_Prod_POS,$Cod_Barras, $Fk_sucursal, $Existencias_R, $ExistenciaPrev, $Recibido, $Lote, $Fecha_Caducidad, $AgregadoPor, $ID_H_O_D, $Factura, $Precio_compra, $Total_Factura);

    $resultadocon = mysqli_stmt_execute($stmt);

    if ($resultadocon) {
        $response['status'] = 'success';
        $response['message'] = 'Registro agregado correctamente.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error en la consulta de inserción: ' . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error en la preparación de la consulta: ' . mysqli_error($conn);
}

echo json_encode($response);

mysqli_close($conn);
?>
