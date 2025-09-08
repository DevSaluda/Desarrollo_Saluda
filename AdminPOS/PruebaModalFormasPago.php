<?php
// Desarrollo_Saluda/AdminPOS/PruebaModalFormasPago.php
// Archivo de prueba para verificar el modal de formas de pago

echo "<h2>Prueba del Modal de Formas de Pago</h2>";

// Simular datos POST
$_POST['folioTicket'] = '1';
$_POST['foliosucursal'] = 'TEST';

echo "<h3>1. Verificación de Archivos</h3>";
$archivos = [
    'Modales/EdicionFormasPagoTicket.php' => 'Modal de edición',
    'Consultas/db_connection.php' => 'Conexión a BD',
    'Consultas/Consultas.php' => 'Consultas generales'
];

echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Archivo</th><th>Descripción</th><th>Estado</th></tr>";

foreach ($archivos as $archivo => $descripcion) {
    $existe = file_exists($archivo);
    $estado = $existe ? '<span style="color: green;">✅ Existe</span>' : '<span style="color: red;">❌ No encontrado</span>';
    echo "<tr><td>$archivo</td><td>$descripcion</td><td>$estado</td></tr>";
}
echo "</table>";

// Verificar conexión a base de datos
echo "<h3>2. Verificación de Base de Datos</h3>";
try {
    include "Consultas/db_connection.php";
    if ($conn) {
        echo "<p style='color: green;'>✅ Conexión a base de datos exitosa</p>";
        
        // Verificar tabla Ventas_POS
        $sql = "SHOW TABLES LIKE 'Ventas_POS'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            echo "<p style='color: green;'>✅ Tabla Ventas_POS encontrada</p>";
            
            // Buscar un ticket de prueba
            $sql = "SELECT Folio_Ticket, FolioSucursal, FormaDePago, CantidadPago FROM Ventas_POS LIMIT 1";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                $ticket = $result->fetch_assoc();
                echo "<p style='color: blue;'>📊 Ticket de prueba encontrado:</p>";
                echo "<ul>";
                echo "<li>Folio: " . $ticket['Folio_Ticket'] . "</li>";
                echo "<li>Sucursal: " . $ticket['FolioSucursal'] . "</li>";
                echo "<li>Forma de Pago: " . $ticket['FormaDePago'] . "</li>";
                echo "<li>Cantidad: " . $ticket['CantidadPago'] . "</li>";
                echo "</ul>";
                
                // Probar el modal con datos reales
                echo "<h3>3. Prueba del Modal con Datos Reales</h3>";
                $_POST['folioTicket'] = $ticket['Folio_Ticket'];
                $_POST['foliosucursal'] = $ticket['FolioSucursal'];
                
                echo "<p>🔗 <a href='Modales/EdicionFormasPagoTicket.php' target='_blank'>Abrir modal directamente</a></p>";
                
            } else {
                echo "<p style='color: orange;'>⚠️ No se encontraron tickets en la base de datos</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ Tabla Ventas_POS no encontrada</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Error de conexión a base de datos</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}

// Probar la función de parseo
echo "<h3>4. Prueba de Función de Parseo</h3>";
try {
    include "Modales/EdicionFormasPagoTicket.php";
    echo "<p style='color: green;'>✅ Modal cargado exitosamente</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error al cargar el modal: " . $e->getMessage() . "</p>";
}

echo "<h3>5. Instrucciones de Prueba</h3>";
echo "<ol>";
echo "<li>Verificar que todos los archivos estén marcados con ✅</li>";
echo "<li>Si hay errores, revisar los permisos de archivos</li>";
echo "<li>Probar el modal desde el módulo Ajuste de Tickets</li>";
echo "<li>Verificar que se muestren los datos del ticket</li>";
echo "<li>Probar la funcionalidad de edición</li>";
echo "</ol>";

echo "<p><strong>Nota:</strong> Este archivo es solo para pruebas. Puede eliminarlo después de verificar que todo funciona correctamente.</p>";
?>
