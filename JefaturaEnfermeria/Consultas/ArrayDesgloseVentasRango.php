<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
// Verifica si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['FechaInicio']) && isset($_POST['FechaFin'])) {
    $fechaInicio = $_POST['FechaInicio'];
    $fechaFin = $_POST['FechaFin'];

    // Formatea las fechas para garantizar que están en formato adecuado para SQL
    $fechaInicio = date('Y-m-d', strtotime($fechaInicio));
    $fechaFin = date('Y-m-d', strtotime($fechaFin));

    // Query SQL para filtrar por rango de fechas
    $sql = "SELECT * FROM Ventas_POS WHERE Fecha_venta BETWEEN '$fechaInicio' AND '$fechaFin'";
    $result = mysqli_query($conn, $sql);

    // Aquí debes incluir tu código para manejar los resultados de la consulta, como mostrarlos en una tabla
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // Procesa cada fila
            echo "Nombre: " . $row["Nombre"] . " - Fecha: " . $row["Fecha"] . "<br>";
        }
    } else {
        echo "No se encontraron resultados.";
    }
} else {
    echo "Datos de fecha no proporcionados correctamente.";
}
?>
