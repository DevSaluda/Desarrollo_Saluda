<?php
include("db_connection.php");
include "Consultas.php";

    $sql = "SELECT * FROM Traspasos_generadosV2 ORDER BY ID_Traspaso_Generado DESC LIMIT 1";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

    // Verificar si hay resultados
    if ($resultset && mysqli_num_rows($resultset) > 0) {
        $Ticketss = mysqli_fetch_assoc($resultset);

        // Verificar si 'Folio_Traspaso' está definido y no es nulo
        if (isset($Ticketss['Folio_Traspaso']) && $Ticketss['Folio_Traspaso'] !== null) {
            $monto1 = intval($Ticketss['Folio_Traspaso']);
            $monto2 = 000000000001; 
            $totalmonto = $monto1 + $monto2;
        } else {
            echo "El valor de 'Folio_Traspaso' es nulo o no está definido.";
        }
    } else {
        echo "No se encontraron resultados en la consulta.";
    }
?>