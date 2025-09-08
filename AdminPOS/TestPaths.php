<?php
// Desarrollo_Saluda/AdminPOS/TestPaths.php
// Prueba de rutas y archivos

echo "<h2>Prueba de Rutas y Archivos</h2>";

echo "<h3>1. Información del Sistema</h3>";
echo "<p><strong>Directorio actual:</strong> " . getcwd() . "</p>";
echo "<p><strong>Archivo actual:</strong> " . __FILE__ . "</p>";
echo "<p><strong>Directorio del archivo:</strong> " . dirname(__FILE__) . "</p>";

echo "<h3>2. Prueba de Rutas</h3>";

// Probar diferentes rutas
$rutas = [
    "Consultas/db_connection.php" => "Ruta relativa desde AdminPOS",
    "../Consultas/db_connection.php" => "Ruta relativa desde Modales",
    dirname(__DIR__) . "/Consultas/db_connection.php" => "Ruta absoluta usando dirname"
];

echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Ruta</th><th>Descripción</th><th>Existe</th><th>Es legible</th></tr>";

foreach ($rutas as $ruta => $descripcion) {
    $existe = file_exists($ruta);
    $legible = $existe ? is_readable($ruta) : false;
    
    $estadoExiste = $existe ? '<span style="color: green;">✅ Sí</span>' : '<span style="color: red;">❌ No</span>';
    $estadoLegible = $legible ? '<span style="color: green;">✅ Sí</span>' : '<span style="color: red;">❌ No</span>';
    
    echo "<tr>";
    echo "<td><code>$ruta</code></td>";
    echo "<td>$descripcion</td>";
    echo "<td>$estadoExiste</td>";
    echo "<td>$estadoLegible</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h3>3. Prueba de Inclusión</h3>";

// Probar incluir el archivo
$rutaCorrecta = dirname(__DIR__) . "/Consultas/db_connection.php";

if (file_exists($rutaCorrecta)) {
    echo "<p style='color: green;'>✅ Archivo encontrado: $rutaCorrecta</p>";
    
    try {
        include $rutaCorrecta;
        if (isset($conn) && $conn) {
            echo "<p style='color: green;'>✅ Archivo incluido exitosamente y conexión establecida</p>";
        } else {
            echo "<p style='color: orange;'>⚠️ Archivo incluido pero no hay conexión</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>❌ Error al incluir: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Archivo no encontrado: $rutaCorrecta</p>";
}

echo "<h3>4. Estructura de Directorios</h3>";
echo "<pre>";
echo "AdminPOS/\n";
echo "├── TestPaths.php (este archivo)\n";
echo "├── Consultas/\n";
echo "│   └── db_connection.php\n";
echo "└── Modales/\n";
echo "    └── EdicionFormasPagoTicket_Fixed.php\n";
echo "</pre>";

echo "<h3>5. Próximos Pasos</h3>";
echo "<ol>";
echo "<li>Verificar que todas las rutas estén marcadas con ✅</li>";
echo "<li>Si hay errores, revisar la estructura de directorios</li>";
echo "<li>Probar el modal después de verificar las rutas</li>";
echo "</ol>";
?>
