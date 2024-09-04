<?php
include_once 'db_connection.php';

$Fk_Folio_Credito =  $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['FolioCred']))));
$Fk_tipo_Credi =  $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['FolioTipocred']))));
$Fk_Caja =  $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['FkCaja']))));
$Nombre_Cred = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Titular']))));
$Cant_Apertura = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['SaldoActual']))));
$Cant_Abono = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Abono']))));
$Fecha_Abono = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['FechaAbono']))));
$Saldo = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['SaldoNuevo']))));
$Fk_Sucursal =  $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Sucursal']))));

$Estatus =  $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Estatus']))));
$CodigoEstatus =  $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Codigo']))));
$Agrega =  $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Usuario']))));
$Sistema =  $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Sistema']))));
$ID_H_O_D =  $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Empresa']))));

// include database configuration file
$sql = "SELECT Fk_Folio_Credito,Fk_tipo_Credi,Nombre_Cred,Cant_Apertura,Cant_Abono,Fecha_Abono,Saldo,Fk_Sucursal,Agrega,Sistema,ID_H_O_D FROM AbonoCreditos_POS
 WHERE Fk_Folio_Credito='$Fk_Folio_Credito' AND Fk_tipo_Credi='$Fk_tipo_Credi' AND Nombre_Cred='$Nombre_Cred' AND Cant_Apertura='$Cant_Apertura' AND Cant_Abono='$Cant_Abono' AND Fecha_Abono='$Fecha_Abono'
 AND Saldo='$Saldo' AND Fk_Sucursal='$Fk_Sucursal' AND Agrega='$Agrega' AND Sistema='$Sistema' AND Cant_Apertura='$Cant_Apertura' AND ID_H_O_D='$ID_H_O_D'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);

// include database configuration file
if ($row && isset($row['Fk_Folio_Credito']) && isset($row['Fk_tipo_Credi']) && isset($row['Nombre_Cred']) && isset($row['Cant_Apertura']) 
    && isset($row['Cant_Abono']) && isset($row['Fecha_Abono']) && isset($row['Saldo']) && isset($row['Fk_Sucursal']) && isset($row['Agrega'])
    && isset($row['Sistema']) && isset($row['ID_H_O_D']) &&
    $row['Fk_Folio_Credito'] == $Fk_Folio_Credito && $row['Fk_tipo_Credi'] == $Fk_tipo_Credi && $row['Nombre_Cred'] == $Nombre_Cred 
    && $row['Cant_Apertura'] == $Cant_Apertura && $row['Cant_Abono'] == $Cant_Abono && $row['Fecha_Abono'] == $Fecha_Abono 
    && $row['Saldo'] == $Saldo && $row['Fk_Sucursal'] == $Fk_Sucursal && $row['Agrega'] == $Agrega
    && $row['Sistema'] == $Sistema && $row['ID_H_O_D'] == $ID_H_O_D) {
    echo json_encode(array("statusCode"=>250));
} else {
    $sql = "INSERT INTO `AbonoCreditos_POS`(`Fk_Folio_Credito`,`Fk_tipo_Credi`,`Fk_Caja`,`Nombre_Cred`,`Cant_Apertura`,`Cant_Abono`,
        `Fecha_Abono`,`Saldo`,`Fk_Sucursal`,`Estatus`,`CodigoEstatus`,`Agrega`,`Sistema`,`ID_H_O_D`) 
        VALUES ('$Fk_Folio_Credito','$Fk_tipo_Credi','$Fk_Caja','$Nombre_Cred','$Cant_Apertura','$Cant_Abono',
        '$Fecha_Abono','$Saldo','$Fk_Sucursal','$Estatus','$CodigoEstatus','$Agrega','$Sistema','$ID_H_O_D')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode"=>200));
    } else {
        echo json_encode(array("statusCode"=>201));
    }
    mysqli_close($conn);
}
?>
