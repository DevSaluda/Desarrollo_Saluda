<?php
include_once 'db_connection.php';
date_default_timezone_set('America/Mexico_City');
$Fk_Fondo = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['FkFondo']))));
$Cantidad_Fondo = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Cantidad']))));
$Empleado = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Empleado']))));
$Sucursal = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));
$Estatus = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Estatus']))));
$CodigoEstatus = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['CodEstatus']))));
$Fecha_Apertura = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Fecha']))));
$Turno = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Turno']))));
$Asignacion = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Asignacion']))));
$D1000 = isset($_POST['BilleteMil']) ? $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['BilleteMil'])))) : 0;
$D500 = isset($_POST['BilleteQuinie']) ? $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['BilleteQuinie'])))) : 0;
$D100 = isset($_POST['BilleteCien']) ? $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['BilleteCien'])))) : 0;
$D200 = isset($_POST['BilleteDosciento']) ? $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['BilleteDosciento'])))) : 0;
$D50 = isset($_POST['BilleteCincuenta']) ? $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['BilleteCincuenta'])))) : 0;
$D20 = isset($_POST['BilleteVeinte']) ? $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['BilleteVeinte'])))) : 0;
$D10 = isset($_POST['MonedaDiez']) ? $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaDiez'])))) : 0;
$D5 = isset($_POST['MonedaCinco']) ? $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaCinco'])))) : 0;
$D2 = isset($_POST['MonedaDos']) ? $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaDos'])))) : 0;
$D1 = isset($_POST['MonedaPeso']) ? $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaPeso'])))) : 0;
$D50C = isset($_POST['MonedaCincuenta']) ? $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaCincuenta'])))) : 0;
$D20C = isset($_POST['MonedaVeinte']) ? $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaVeinte'])))) : 0;
$D10C = isset($_POST['MonedaDiezC']) ? $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['MonedaDiezC'])))) : 0;
$Valor_Total_Caja = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['TotalCaja']))));
$Sistema = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
$ID_H_O_D = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['Empresa']))));
$MedicoEnturno = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['MedicoEnturno']))));
$EnfermeroEnturno = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['EnfermeroEnturno']))));

// Verificar si ya existe un registro con los mismos valores
$sql = "SELECT Empleado,Sucursal,Estatus,Fecha_Apertura,ID_H_O_D,Cantidad_Fondo,Turno,Asignacion FROM Cajas_POS
        WHERE Empleado='$Empleado' AND Sucursal='$Sucursal' AND Estatus='$Estatus' AND Fecha_Apertura='$Fecha_Apertura' AND Cantidad_Fondo='$Cantidad_Fondo'AND Turno='$Turno' 
        AND Asignacion='$Asignacion' AND ID_H_O_D='$ID_H_O_D'";
$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);

// Verificar si ya existe un registro con los mismos valores
if ($row && $row['Empleado'] == $Empleado && $row['Sucursal'] == $Sucursal && $row['Estatus'] == $Estatus && $row['Fecha_Apertura'] == $Fecha_Apertura
    && $row['Cantidad_Fondo'] == $Cantidad_Fondo && $row['ID_H_O_D'] == $ID_H_O_D && $row['Turno'] == $Turno && $row['Asignacion'] == $Asignacion) {
    echo json_encode(array("statusCode" => 250));
} else {
    // Insertar nuevo registro
    $sql = "INSERT INTO `Cajas_POS`( `Fk_Fondo`,`Cantidad_Fondo`,`Empleado`,`Sucursal`,`Estatus`,`CodigoEstatus`,`Fecha_Apertura`,`Turno`,`Asignacion`,`D1000`,`D500`,`D200`,`D100`,`D50`,
            `D20`,`D10`,`D5`,`D2`,`D1`,`D50C`,`D20C`,`D10C`,`Valor_Total_Caja`,`Sistema`,`ID_H_O_D`,`MedicoEnturno`,`EnfermeroEnturno`) 
            VALUES ('$Fk_Fondo','$Cantidad_Fondo','$Empleado','$Sucursal','$Estatus','$CodigoEstatus','$Fecha_Apertura','$Turno','$Asignacion','$D1000','$D500','$D200','$D100','$D50',
            '$D20','$D10','$D5','$D2','$D1','$D50C','$D20C','$D10C','$Valor_Total_Caja','$Sistema','$ID_H_O_D','$MedicoEnturno','$EnfermeroEnturno')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
?>
