<?php
// Conexión a la base de datos
include "../Consultas/db_connection.php";

// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busqueda = $_POST["busqueda"];

    // Consulta SQL para buscar por nombre o código de barras
    $sql = "SELECT * FROM Productos_POS WHERE Nombre_Prod LIKE '%$busqueda%' OR Cod_Barra = '$busqueda'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar resultados
        while($row = $result->fetch_assoc()) {
            echo "Nombre: " . $row["nombre"]. " - Código de Barras: " . $row["codigo_barras"]. "<br>";
        }
    } else {
        echo "No se encontraron resultados.";
    }
}
$conn->close();
?>


<html>
<head>
    <title>Búsqueda de Productos</title>
</head>
<body>
    <h2>Buscar Producto</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Nombre o Código de Barras:</label>
        <input type="text" name="busqueda">
        <input type="submit" value="Buscar">
    </form>
</body>
</html>
