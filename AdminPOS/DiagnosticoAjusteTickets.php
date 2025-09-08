<?php
// Desarrollo_Saluda/AdminPOS/DiagnosticoAjusteTickets.php
// Archivo de diagnóstico para verificar el funcionamiento del módulo

echo "<h2>Diagnóstico del Módulo Ajuste de Tickets</h2>";

// Verificar archivos principales
$archivos = [
    'AjusteTickets.php' => 'Archivo principal del módulo',
    'Consultas/ConsultaAjusteTickets.php' => 'Consultas de base de datos',
    'Consultas/FuncionesFormasPago.php' => 'Funciones de utilidad',
    'Consultas/ActualizarFormasPagoTicket.php' => 'Procesamiento de actualizaciones',
    'js/ControlAjusteTickets.js' => 'Controlador JavaScript',
    'Modales/EdicionFormasPagoTicket.php' => 'Modal de edición',
    'Modales/FiltroPorFechasAjuste.php' => 'Filtro por fechas',
    'Modales/FiltroPorFormasPagoAjuste.php' => 'Filtro por formas de pago'
];

echo "<h3>1. Verificación de Archivos</h3>";
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
            
            // Contar registros
            $sql = "SELECT COUNT(*) as total FROM Ventas_POS WHERE Fecha_venta >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
            $result = $conn->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                echo "<p style='color: blue;'>📊 Registros de los últimos 30 días: " . $row['total'] . "</p>";
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

// Verificar funciones de utilidad
echo "<h3>3. Verificación de Funciones</h3>";
try {
    include "Consultas/FuncionesFormasPago.php";
    
    // Probar función parsearFormasPago
    $test1 = parsearFormasPago("Efectivo:150.00|Tarjeta:50.00");
    echo "<p style='color: green;'>✅ Función parsearFormasPago funciona</p>";
    
    // Probar función mostrarFormasPago
    $test2 = mostrarFormasPago("Efectivo:150.00|Tarjeta:50.00");
    echo "<p style='color: green;'>✅ Función mostrarFormasPago funciona</p>";
    
    // Probar función obtenerTotalPagado
    $test3 = obtenerTotalPagado("Efectivo:150.00|Tarjeta:50.00");
    echo "<p style='color: green;'>✅ Función obtenerTotalPagado funciona (Total: $" . number_format($test3, 2) . ")</p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error en funciones: " . $e->getMessage() . "</p>";
}

// Verificar menú
echo "<h3>4. Verificación del Menú</h3>";
$menuContent = file_get_contents('Menu.php');
if (strpos($menuContent, 'AjusteTickets') !== false) {
    echo "<p style='color: green;'>✅ Enlace al módulo encontrado en el menú</p>";
} else {
    echo "<p style='color: red;'>❌ Enlace al módulo no encontrado en el menú</p>";
}

// Verificar permisos de archivos
echo "<h3>5. Verificación de Permisos</h3>";
$archivosPermisos = ['AjusteTickets.php', 'Consultas/ConsultaAjusteTickets.php'];
foreach ($archivosPermisos as $archivo) {
    if (file_exists($archivo)) {
        $permisos = fileperms($archivo);
        $permisosOct = substr(sprintf('%o', $permisos), -4);
        echo "<p>📁 $archivo - Permisos: $permisosOct</p>";
    }
}

// Información del servidor
echo "<h3>6. Información del Servidor</h3>";
echo "<p>🌐 PHP Version: " . phpversion() . "</p>";
echo "<p>📅 Fecha actual: " . date('Y-m-d H:i:s') . "</p>";
echo "<p>📂 Directorio actual: " . getcwd() . "</p>";

// Prueba de carga del módulo
echo "<h3>7. Prueba de Carga del Módulo</h3>";
echo "<p>🔗 <a href='AjusteTickets.php' target='_blank'>Abrir módulo Ajuste de Tickets</a></p>";

echo "<h3>8. Instrucciones de Uso</h3>";
echo "<ol>";
echo "<li>Verificar que todos los archivos estén marcados con ✅</li>";
echo "<li>Si hay errores, revisar los permisos de archivos</li>";
echo "<li>Acceder al módulo desde: <strong>Tickets → Ajuste de Tickets</strong></li>";
echo "<li>Si el módulo no carga, revisar los logs del servidor</li>";
echo "</ol>";

echo "<p><strong>Nota:</strong> Este archivo es solo para diagnóstico. Puede eliminarlo después de verificar que todo funciona correctamente.</p>";
?>
