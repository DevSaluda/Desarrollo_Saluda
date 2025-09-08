<?php
// Desarrollo_Saluda/AdminPOS/TestLogsTable.php
// Prueba de la estructura de la tabla Logs_Sistema

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Prueba de la Tabla Logs_Sistema</h2>";

try {
    include "Consultas/db_connection.php";
    
    if (!$conn) {
        echo '<div class="alert alert-danger">Error: No hay conexión a la base de datos</div>';
        exit;
    }
    
    echo "<h3>1. Verificar si la tabla existe</h3>";
    $sql = "SHOW TABLES LIKE 'Logs_Sistema'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        echo "<p style='color: green;'>✅ Tabla Logs_Sistema encontrada</p>";
        
        echo "<h3>2. Estructura de la tabla</h3>";
        $sql = "SHOW COLUMNS FROM Logs_Sistema";
        $result = $conn->query($sql);
        
        if ($result) {
            echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
            echo "<tr><th>Campo</th><th>Tipo</th><th>Nulo</th><th>Clave</th><th>Por defecto</th><th>Extra</th></tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Field'] . "</td>";
                echo "<td>" . $row['Type'] . "</td>";
                echo "<td>" . $row['Null'] . "</td>";
                echo "<td>" . $row['Key'] . "</td>";
                echo "<td>" . $row['Default'] . "</td>";
                echo "<td>" . $row['Extra'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            echo "<h3>3. Prueba de inserción</h3>";
            
            // Obtener columnas disponibles
            $columns = [];
            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
                $columns[] = $row['Field'];
            }
            
            echo "<p><strong>Columnas disponibles:</strong> " . implode(', ', $columns) . "</p>";
            
            // Probar inserción usando la estructura correcta de la tabla
            $usuario = 'Sistema';
            $empresa = 'Saluda';
            $tipoLog = 'PRUEBA';
            $sistema = 'AdminPOS';
            
            // Usar la estructura correcta: Usuario, Tipo_log, Sistema, ID_H_O_D
            $logSql = "INSERT INTO Logs_Sistema (Usuario, Tipo_log, Sistema, ID_H_O_D) 
                       VALUES ('$usuario', '$tipoLog', '$sistema', '$empresa')";
            echo "<p>Usando estructura correcta de la tabla Logs_Sistema</p>";
            
            echo "<p><strong>SQL de prueba:</strong> <code>$logSql</code></p>";
            
            if ($conn->query($logSql)) {
                echo "<p style='color: green;'>✅ Inserción de prueba exitosa</p>";
                
                // Eliminar el registro de prueba
                $deleteSql = "DELETE FROM Logs_Sistema WHERE Tipo_log = 'PRUEBA' AND Usuario = 'Sistema' LIMIT 1";
                $conn->query($deleteSql);
                echo "<p style='color: blue;'>🗑️ Registro de prueba eliminado</p>";
            } else {
                echo "<p style='color: red;'>❌ Error en inserción de prueba: " . $conn->error . "</p>";
            }
            
        } else {
            echo "<p style='color: red;'>❌ Error al obtener estructura: " . $conn->error . "</p>";
        }
        
    } else {
        echo "<p style='color: red;'>❌ Tabla Logs_Sistema no encontrada</p>";
        
        echo "<h3>Tablas disponibles que contienen 'log':</h3>";
        $sql = "SHOW TABLES LIKE '%log%'";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_array()) {
                echo "<li>" . $row[0] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No se encontraron tablas con 'log' en el nombre</p>";
        }
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}

echo "<h3>4. Próximos Pasos</h3>";
echo "<ol>";
echo "<li>Verificar que la tabla Logs_Sistema existe</li>";
echo "<li>Revisar la estructura de columnas</li>";
echo "<li>Probar la inserción de prueba</li>";
echo "<li>Corregir el archivo ActualizarFormasPagoTicket.php si es necesario</li>";
echo "</ol>";
?>
