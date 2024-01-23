<?php
include_once("https://saludapos.com/POS2/Consultas/db_connection.php");
include "https://saludapos.com/POS2/Consultas/Consultas.php";


$sql = "SELECT * FROM Ventas_POS  WHERE Fk_sucursal='" . $row['Fk_Sucursal'] . "' ORDER BY Venta_POS_ID DESC LIMIT 1";
$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
$Ticketss = mysqli_fetch_assoc($resultset);

$monto1 = $Ticketss['Folio_Ticket'];
$monto2 = 1;
$totalmonto = $monto1 + $monto2;

// Obtener la longitud original de $Ticketss['Folio_Ticket']
$longitud_original = strlen($Ticketss['Folio_Ticket']);

// Mostrar $totalmonto con los caracteres '0000000000' (ajustando la longitud)
$totalmonto_con_ceros = str_pad($totalmonto, $longitud_original, '0', STR_PAD_LEFT);

;
?>
