<?php
// Desarrollo_Saluda/AdminPOS/Consultas/ExportarAjusteTickets.php
include "db_connection.php";
include "FuncionesFormasPago.php";

$accion = isset($_POST['accion']) ? $_POST['accion'] : '';

if ($accion === 'exportar_excel') {
    exportarAExcel();
} else {
    echo "Acción no válida";
}

function exportarAExcel() {
    global $conn;
    
    // Configurar headers para Excel
    header('Content-Type: application/vnd.ms-excel; charset=utf-8');
    header('Content-Disposition: attachment; filename="ajuste_tickets_' . date('Y-m-d') . '.xls"');
    header('Cache-Control: max-age=0');
    
    // BOM para UTF-8
    echo "\xEF\xBB\xBF";
    
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
            ORDER BY v.Fecha_venta DESC, v.Folio_Ticket DESC";
    
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        // Crear tabla HTML para Excel
        echo '<table border="1">';
        echo '<tr style="background-color: #4472C4; color: white; font-weight: bold;">';
        echo '<td>Folio</td>';
        echo '<td>Sucursal</td>';
        echo '<td>Fecha</td>';
        echo '<td>Total</td>';
        echo '<td>Formas de Pago</td>';
        echo '<td>Vendedor</td>';
        echo '<td>Productos</td>';
        echo '<td>Tipo de Pago</td>';
        echo '</tr>';
        
        while ($row = $result->fetch_assoc()) {
            $folioTicket = $row['Folio_Ticket'];
            $folioSucursal = $row['FolioSucursal'];
            $fecha = date('d/m/Y H:i', strtotime($row['Fecha_venta']));
            $total = number_format($row['Total_VentaG'], 2);
            $formasPago = $row['FormaDePago'];
            $vendedor = $row['AgregadoPor'];
            $productos = $row['productos_ticket'];
            
            // Determinar tipo de pago
            $tipoPago = strpos($formasPago, '|') !== false ? 'Múltiples' : 'Simple';
            
            // Parsear formas de pago para Excel
            $formasPagoExcel = '';
            if (strpos($formasPago, '|') !== false) {
                $partes = explode('|', $formasPago);
                $formas = [];
                foreach ($partes as $parte) {
                    if (strpos($parte, ':') !== false) {
                        list($forma, $monto) = explode(':', $parte);
                        $formas[] = trim($forma) . ': $' . number_format(trim($monto), 2);
                    }
                }
                $formasPagoExcel = implode(' | ', $formas);
            } else if (strpos($formasPago, ':') !== false) {
                list($forma, $monto) = explode(':', $formasPago);
                $formasPagoExcel = trim($forma) . ': $' . number_format(trim($monto), 2);
            } else {
                $formasPagoExcel = $formasPago;
            }
            
            echo '<tr>';
            echo '<td>' . $folioTicket . '</td>';
            echo '<td>' . $row['Nombre_Sucursal'] . '</td>';
            echo '<td>' . $fecha . '</td>';
            echo '<td>$' . $total . '</td>';
            echo '<td>' . $formasPagoExcel . '</td>';
            echo '<td>' . $vendedor . '</td>';
            echo '<td>' . $productos . '</td>';
            echo '<td>' . $tipoPago . '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
    } else {
        echo 'No se encontraron datos para exportar';
    }
}
?>
