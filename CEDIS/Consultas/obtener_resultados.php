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
                Fk_SucDestino = '$sucursal' AND ProveedorFijo = 'CEDIS'
            ORDER BY Factura DESC";

    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            echo '<option value="">Seleccione una Factura:</option>';
            while($row = $result->fetch_assoc()) {
                echo '<option value="' . htmlspecialchars($row['Factura'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row['Factura'], ENT_QUOTES, 'UTF-8') . '</option>';
            }
        } else {
            echo '<option value="">No se encontraron resultados.</option>';
        }
    } else {
        echo '<option value="">Error en la consulta.</option>';
    }
} else {
    echo '<option value="">Seleccione una Factura:</option>';
}

$conn->close();
?>
