<?php

include("db_connection.php");
include "Consultas.php";
if (isset($_POST['sucursal'])) {
    $sucursal = $conn->real_escape_string($_POST['sucursal']);

    $sql = "SELECT DISTINCT
                Fk_SucDestino,
                Num_Orden AS Orden,
                Num_Factura AS Factura
            FROM 
                Traspasos_generados
            WHERE 
                Fk_SucDestino = '$sucursal'
            ORDER BY Factura DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Fk_SucDestino</th><th>Orden</th><th>Factura</th></tr>';
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['Fk_SucDestino'] . '</td>';
            echo '<td>' . $row['Orden'] . '</td>';
            echo '<td>' . $row['Factura'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No se encontraron resultados.';
    }
}

$conn->close();
?>
