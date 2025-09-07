<?php
// Desarrollo_Saluda/AdminPOS/PruebaFormasPago.php
// Archivo de prueba para verificar el funcionamiento del módulo de formas de pago

include "Consultas/db_connection.php";
include "Consultas/FuncionesFormasPago.php";

echo "<h2>Prueba del Módulo de Formas de Pago</h2>";

// Prueba 1: Función parsearFormasPago
echo "<h3>Prueba 1: Función parsearFormasPago</h3>";

$casos = [
    "Efectivo:150.00|Tarjeta:50.00",
    "Efectivo:200.00",
    "Transferencia:100.00",
    "Efectivo"
];

foreach ($casos as $caso) {
    echo "<p><strong>Caso:</strong> '$caso'</p>";
    $resultado = parsearFormasPago($caso);
    echo "<pre>" . print_r($resultado, true) . "</pre>";
}

// Prueba 2: Función mostrarFormasPago
echo "<h3>Prueba 2: Función mostrarFormasPago</h3>";

foreach ($casos as $caso) {
    echo "<p><strong>Caso:</strong> '$caso'</p>";
    echo "<div>" . mostrarFormasPago($caso) . "</div>";
}

// Prueba 3: Función obtenerTotalPagado
echo "<h3>Prueba 3: Función obtenerTotalPagado</h3>";

foreach ($casos as $caso) {
    echo "<p><strong>Caso:</strong> '$caso' - Total: $" . number_format(obtenerTotalPagado($caso), 2) . "</p>";
}

// Prueba 4: Función validarFormasPago
echo "<h3>Prueba 4: Función validarFormasPago</h3>";

$totalTicket = 200.00;
foreach ($casos as $caso) {
    echo "<p><strong>Caso:</strong> '$caso' (Total ticket: $" . number_format($totalTicket, 2) . ")</p>";
    $validacion = validarFormasPago($caso, $totalTicket);
    echo "<pre>" . print_r($validacion, true) . "</pre>";
}

// Prueba 5: Función crearCadenaFormasPago
echo "<h3>Prueba 5: Función crearCadenaFormasPago</h3>";

$formasPago = [
    ['forma' => 'Efectivo', 'monto' => 150.00],
    ['forma' => 'Tarjeta', 'monto' => 50.00]
];

echo "<p><strong>Array de entrada:</strong></p>";
echo "<pre>" . print_r($formasPago, true) . "</pre>";
echo "<p><strong>Cadena generada:</strong> '" . crearCadenaFormasPago($formasPago) . "'</p>";

// Prueba 6: Verificar conexión a base de datos
echo "<h3>Prueba 6: Conexión a Base de Datos</h3>";

if ($conn) {
    echo "<p style='color: green;'>✅ Conexión a base de datos exitosa</p>";
    
    // Verificar que la tabla Ventas_POS existe
    $sql = "SHOW TABLES LIKE 'Ventas_POS'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        echo "<p style='color: green;'>✅ Tabla Ventas_POS encontrada</p>";
        
        // Obtener un ticket de ejemplo
        $sql = "SELECT Folio_Ticket, FolioSucursal, FormaDePago, Total_VentaG 
                FROM Ventas_POS 
                WHERE FormaDePago IS NOT NULL 
                LIMIT 1";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $ticket = $result->fetch_assoc();
            echo "<p style='color: green;'>✅ Ticket de ejemplo encontrado:</p>";
            echo "<ul>";
            echo "<li><strong>Folio:</strong> " . $ticket['Folio_Ticket'] . "</li>";
            echo "<li><strong>Sucursal:</strong> " . $ticket['FolioSucursal'] . "</li>";
            echo "<li><strong>Forma de Pago:</strong> " . $ticket['FormaDePago'] . "</li>";
            echo "<li><strong>Total:</strong> $" . number_format($ticket['Total_VentaG'], 2) . "</li>";
            echo "</ul>";
        } else {
            echo "<p style='color: orange;'>⚠️ No se encontraron tickets en la base de datos</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Tabla Ventas_POS no encontrada</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Error de conexión a base de datos</p>";
}

// Prueba 7: Verificar archivos del módulo
echo "<h3>Prueba 7: Verificación de Archivos</h3>";

$archivos = [
    'Modales/EdicionFormasPagoTicket.php',
    'Consultas/ActualizarFormasPagoTicket.php',
    'Consultas/FuncionesFormasPago.php',
    'js/EdicionFormasPago.js',
    'ReporteFormasPago.php'
];

foreach ($archivos as $archivo) {
    if (file_exists($archivo)) {
        echo "<p style='color: green;'>✅ $archivo - Existe</p>";
    } else {
        echo "<p style='color: red;'>❌ $archivo - No encontrado</p>";
    }
}

echo "<h3>Resumen de Pruebas</h3>";
echo "<p>Si todas las pruebas muestran ✅, el módulo está listo para usar.</p>";
echo "<p>Para usar el módulo:</p>";
echo "<ol>";
echo "<li>Ir a Ventas en el AdminPOS</li>";
echo "<li>Buscar un ticket</li>";
echo "<li>Hacer clic en 'Editar Formas de Pago'</li>";
echo "<li>Configurar las formas de pago deseadas</li>";
echo "<li>Guardar los cambios</li>";
echo "</ol>";

echo "<p><strong>Nota:</strong> Este archivo es solo para pruebas. Puede eliminarlo después de verificar que todo funciona correctamente.</p>";
?>
