<?php
include("db_connection.php");
include "Consultas.php";

if (isset($_POST['sucursal'])) {
    $sucursal = $conn->real_escape_string($_POST['sucursal']);

    $sql = "SELECT DISTINCT
                Num_Factura AS Factura
            FROM 
                Traspasos_generados
            WHERE 
                Fk_SucDestino = '$sucursal'
            ORDER BY Factura DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<option value="">Seleccione una Factura:</option>';
        while($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['Factura'] . '">' . $row['Factura'] . '</option>';
        }
    } else {
        echo '<option value="">No se encontraron resultados.</option>';
    }
}

$conn->close();
?>
