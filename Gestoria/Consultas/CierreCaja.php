<?php
include_once 'db_connection.php';

$Fk_Caja = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['NumeroCaja']))));
$Empleado = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Usuario']))));
$Sucursal = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['FkSucursalL']))));
$Turno = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['TurnoCorte']))));
$Ticket_Inicial = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['TicketInicial']))));
$Ticket_Final = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['TicketFinal']))));
$TotalTickets = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['TotalTickets']))));
$D1000 = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['BilleteMil']))));
$D500 = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['BilleteQuinie']))));
$D100 = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['BilleteCien']))));
$D200 = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['BilleteDos']))));
$D50 = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['BilleteCincuenta']))));
$D20 = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['BilleteVeinte']))));
$D10 = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['MonedaDiez']))));
$D5 = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['MonedaCinco']))));
$D2 = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['MonedaDos']))));
$D1 = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['MonedaPeso']))));
$D50C = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['MonedaCincuenta']))));
$D20C = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['MonedaVeinte']))));
$D10C = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['MonedaDiezC']))));
$Valor_Total_Caja = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['TotalCaja']))));
$Sistema = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Sistema']))));
$ID_H_O_D = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Empresa']))));

$sql = "SELECT Fk_Caja, Empleado, Sucursal, ID_H_O_D FROM Cortes_Cajas_POS
        WHERE Fk_Caja='$Fk_Caja' AND Empleado='$Empleado' AND Sucursal='$Sucursal' AND ID_H_O_D='$ID_H_O_D'";
$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));

if ($resultset && mysqli_num_rows($resultset) > 0) {
    $row = mysqli_fetch_assoc($resultset);

    if ($row['Fk_Caja'] == $Fk_Caja && $row['Empleado'] == $Empleado && $row['Sucursal'] == $Sucursal && $row['ID_H_O_D'] == $ID_H_O_D) {
        echo json_encode(array("statusCode" => 250));
    } else {
        $sql = "INSERT INTO `Cortes_Cajas_POS`(`Fk_Caja`, `Empleado`, `Sucursal`,`Turno`,`Ticket_Inicial`,`Ticket_Final`,`TotalTickets`,`D1000`, `D500`, `D200`, `D100`, `D50`, `D20`, `D10`, `D5`, `D2`, `D1`, `D50C`, 
            `D20C`, `D10C`, `Valor_Total_Caja`, `Sistema`, `ID_H_O_D`) 
            VALUES ('$Fk_Caja', '$Empleado', '$Sucursal','$Turno','$Ticket_Inicial','$Ticket_Final','$TotalTickets','$D1000', '$D500', '$D200', '$D100', '$D50', '$D20', '$D10', '$D5', '$D2', '$D1', '$D50C', 
            '$D20C', '$D10C', '$Valor_Total_Caja', '$Sistema', '$ID_H_O_D')";
        
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo json_encode(array("statusCode" => 201));
        }
    }
} else {
    // Si no se recuperó ninguna fila, realizar la inserción en la base de datos
    $sql = "INSERT INTO `Cortes_Cajas_POS`(`Fk_Caja`, `Empleado`, `Sucursal`,`Turno`,`Ticket_Inicial`,`Ticket_Final`,`TotalTickets`,`D1000`, `D500`, `D200`, `D100`, `D50`, `D20`, `D10`, `D5`, `D2`, `D1`, `D50C`, 
        `D20C`, `D10C`, `Valor_Total_Caja`, `Sistema`, `ID_H_O_D`) 
        VALUES ('$Fk_Caja', '$Empleado', '$Sucursal','$Turno','$Ticket_Inicial','$Ticket_Final','$TotalTickets','$D1000', '$D500', '$D200', '$D100', '$D50', '$D20', '$D10', '$D5', '$D2', '$D1', '$D50C', 
        '$D20C', '$D10C', '$Valor_Total_Caja', '$Sistema', '$ID_H_O_D')";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
}

mysqli_close($conn);
?>
