
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de Búsqueda</title>
</head>
<body>
    <h2>Resultados de Búsqueda</h2>
    <?php
    // Verificar si se ha enviado un nombre de paciente
    if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
        //conexion
        include "Consultas/db.connection.php";

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Sanitizar el nombre del paciente para evitar inyecciones SQL
        $nombre_paciente = $conexion->real_escape_string($_GET['nombre']);

        // Consulta SQL para buscar pacientes por nombre
        $sql = "SELECT * FROM Siginos_VitalesV2 WHERE Nombre_Paciente LIKE '%$nombre_paciente%'";

        // Ejecutar la consulta
        $resultado = $conexion->query($sql);

        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            // Mostrar los resultados
            echo "<ul>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<li>" . $fila['nombre'] . "</li>";
                
            }
            echo "</ul>";
        } else {
            echo "No se encontraron resultados para el nombre: $nombre_paciente";
        }

        // Cerrar la conexión
        $conexion->close();
    } else {
        echo "Por favor ingrese un nombre de paciente para buscar.";
    }
    ?>
</body>
</html>
