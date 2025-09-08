<?php
// Desarrollo_Saluda/AdminPOS/TestDB.php
// Prueba simple de conexión a base de datos

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Prueba de Conexión a Base de Datos</h2>";

try {
    echo "<p>1. Incluyendo db_connection.php...</p>";
    include "Consultas/db_connection.php";
    
    if ($conn) {
        echo "<p style='color: green;'>✅ Conexión exitosa</p>";
        
        echo "<p>2. Probando consulta simple...</p>";
        $sql = "SELECT COUNT(*) as total FROM Ventas_POS LIMIT 1";
        $result = $conn->query($sql);
        
        if ($result) {
            $row = $result->fetch_assoc();
            echo "<p style='color: green;'>✅ Consulta exitosa. Total registros: " . $row['total'] . "</p>";
            
            echo "<p>3. Probando consulta con JOIN...</p>";
            $sql2 = "SELECT Ventas_POS.Folio_Ticket, Ventas_POS.FolioSucursal, SucursalesCorre.Nombre_Sucursal 
                     FROM Ventas_POS 
                     INNER JOIN SucursalesCorre ON Ventas_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC 
                     LIMIT 1";
            $result2 = $conn->query($sql2);
            
            if ($result2 && $result2->num_rows > 0) {
                $ticket = $result2->fetch_assoc();
                echo "<p style='color: green;'>✅ JOIN exitoso. Ticket encontrado:</p>";
                echo "<ul>";
                echo "<li>Folio: " . $ticket['Folio_Ticket'] . "</li>";
                echo "<li>Sucursal: " . $ticket['FolioSucursal'] . "</li>";
                echo "<li>Nombre Sucursal: " . $ticket['Nombre_Sucursal'] . "</li>";
                echo "</ul>";
                
                echo "<p>4. Probando consulta específica del modal...</p>";
                $sql3 = "SELECT Ventas_POS.*, SucursalesCorre.Nombre_Sucursal 
                         FROM Ventas_POS 
                         INNER JOIN SucursalesCorre ON Ventas_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC
                         WHERE Ventas_POS.Folio_Ticket = '" . $ticket['Folio_Ticket'] . "' 
                         AND Ventas_POS.FolioSucursal = '" . $ticket['FolioSucursal'] . "' 
                         LIMIT 1";
                $result3 = $conn->query($sql3);
                
                if ($result3 && $result3->num_rows > 0) {
                    $ticketData = $result3->fetch_assoc();
                    echo "<p style='color: green;'>✅ Consulta del modal exitosa</p>";
                    echo "<p>Datos del ticket:</p>";
                    echo "<ul>";
                    echo "<li>Forma de Pago: " . $ticketData['FormaDePago'] . "</li>";
                    echo "<li>Cantidad Pago: " . $ticketData['CantidadPago'] . "</li>";
                    echo "<li>Total Venta: " . $ticketData['Total_VentaG'] . "</li>";
                    echo "</ul>";
                } else {
                    echo "<p style='color: red;'>❌ Error en consulta del modal</p>";
                }
            } else {
                echo "<p style='color: red;'>❌ Error en JOIN</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ Error en consulta simple: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ No hay conexión a la base de datos</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
    echo "<p>Archivo: " . $e->getFile() . "</p>";
    echo "<p>Línea: " . $e->getLine() . "</p>";
}

echo "<h3>Próximos Pasos</h3>";
echo "<ol>";
echo "<li>Si todas las pruebas son exitosas, el problema está en el modal</li>";
echo "<li>Si hay errores, revisar la configuración de la base de datos</li>";
echo "<li>Probar el modal de debug después de verificar la BD</li>";
echo "</ol>";
?>
