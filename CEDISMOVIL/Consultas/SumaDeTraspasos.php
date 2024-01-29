<?php
include("db_connection.php");
include "Consultas.php";

$sql = "SELECT * FROM Traspasos_generados ORDER BY ID_Traspaso_Generado DESC LIMIT 1";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

// Verificar si hay resultados
if ($resultset && mysqli_num_rows($resultset) > 0) {
    $Ticketss = mysqli_fetch_assoc($resultset);

    // Verificar si 'NumFactura' está definido y no es nulo
    if (isset($Ticketss['NumFactura']) && $Ticketss['NumFactura'] !== null) {
        $monto1 = intval($Ticketss['NumFactura']);
        $monto2 = 000000000001; 
        $totalmonto = $monto1 + $monto2;
    } else {
        echo "El valor de 'NumFactura' es nulo o no está definido.";
    }
} else {
    echo "No se encontraron resultados en la consulta.";
}
?>
