<?php
// Desarrollo_Saluda/AdminPOS/PruebaConsultaAjuste.php
// Archivo de prueba para verificar la consulta de ajuste de tickets

include "Consultas/db_connection.php";
include "Consultas/FuncionesFormasPago.php";

echo "<h2>Prueba de Consulta de Ajuste de Tickets</h2>";

try {
    // Probar la consulta principal
    $sql = "SELECT DISTINCT 
                v.Folio_Ticket,
                v.FolioSucursal,
                v.Fecha_venta,
                v.Total_VentaG,
                v.FormaDePago,
                v.CantidadPago,
                v.Pagos_tarjeta,
                v.AgregadoPor,
                s.Nombre_Sucursal,
                COUNT(*) as productos_ticket
            FROM Ventas_POS v
            INNER JOIN SucursalesCorre s ON v.Fk_sucursal = s.ID_SucursalC
            WHERE v.Fecha_venta >= DATE_SUB(NOW(), INTERVAL 30 DAY)
            GROUP BY v.Folio_Ticket, v.FolioSucursal, v.Fecha_venta, v.Total_VentaG, v.FormaDePago, v.CantidadPago, v.Pagos_tarjeta, v.AgregadoPor, s.Nombre_Sucursal
            ORDER BY v.Fecha_venta DESC, v.Folio_Ticket DESC
            LIMIT 5";
    
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        echo "<p style='color: green;'>✅ Consulta ejecutada exitosamente</p>";
        echo "<p>📊 Se encontraron " . $result->num_rows . " registros de prueba</p>";
        
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>Folio</th><th>Sucursal</th><th>Fecha</th><th>Total</th><th>Forma de Pago</th><th>Vendedor</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            $folioTicket = $row['Folio_Ticket'];
            $folioSucursal = $row['FolioSucursal'];
            $fecha = date('d/m/Y H:i', strtotime($row['Fecha_venta']));
            $total = number_format($row['Total_VentaG'], 2);
            $formasPago = $row['FormaDePago'];
            $vendedor = $row['AgregadoPor'];
            
            echo "<tr>";
            echo "<td>$folioTicket</td>";
            echo "<td>" . $row['Nombre_Sucursal'] . "</td>";
            echo "<td>$fecha</td>";
            echo "<td>$$total</td>";
            echo "<td>$formasPago</td>";
            echo "<td>$vendedor</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
        // Probar las funciones de utilidad
        echo "<h3>Prueba de Funciones de Utilidad</h3>";
        
        $testFormas = "Efectivo:150.00|Tarjeta:50.00";
        $formasParseadas = parsearFormasPago($testFormas);
        echo "<p><strong>Formas parseadas:</strong></p>";
        echo "<pre>" . print_r($formasParseadas, true) . "</pre>";
        
        $totalPagado = obtenerTotalPagado($testFormas);
        echo "<p><strong>Total pagado:</strong> $" . number_format($totalPagado, 2) . "</p>";
        
        $htmlFormas = mostrarFormasPago($testFormas);
        echo "<p><strong>HTML generado:</strong></p>";
        echo $htmlFormas;
        
    } else {
        echo "<p style='color: orange;'>⚠️ No se encontraron registros en los últimos 30 días</p>";
        echo "<p>Esto puede ser normal si no hay ventas recientes.</p>";
        
        // Probar con un rango más amplio
        $sql2 = "SELECT COUNT(*) as total FROM Ventas_POS";
        $result2 = $conn->query($sql2);
        if ($result2) {
            $row2 = $result2->fetch_assoc();
            echo "<p>📊 Total de registros en Ventas_POS: " . $row2['total'] . "</p>";
        }
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error en la consulta: " . $e->getMessage() . "</p>";
}

echo "<h3>Próximos Pasos</h3>";
echo "<ol>";
echo "<li>Si la consulta funciona, el módulo debería cargar correctamente</li>";
echo "<li>Acceder a: <a href='AjusteTickets.php'>AjusteTickets.php</a></li>";
echo "<li>Verificar que aparezca en el menú: <strong>Tickets → Ajuste de Tickets</strong></li>";
echo "</ol>";

echo "<p><strong>Nota:</strong> Este archivo es solo para pruebas. Puede eliminarlo después de verificar que todo funciona.</p>";
?>
