<?php
// Desarrollo_Saluda/AdminPOS/Consultas/FiltrapormediodesucursalconajaxAjuste.php
include "db_connection.php";
include "FuncionesFormasPago.php";

$sucursal = $_POST['Sucursal'];

if (!empty($sucursal)) {
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
            WHERE v.Fk_sucursal = '$sucursal'
            AND v.Fecha_venta >= DATE_SUB(NOW(), INTERVAL 30 DAY)
            GROUP BY v.Folio_Ticket, v.FolioSucursal, v.Fecha_venta, v.Total_VentaG, v.FormaDePago, v.CantidadPago, v.Pagos_tarjeta, v.AgregadoPor, s.Nombre_Sucursal
            ORDER BY v.Fecha_venta DESC, v.Folio_Ticket DESC
            LIMIT 100";
} else {
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
            LIMIT 100";
}

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    generarTablaHTML($result);
} else {
    echo '<div class="alert alert-info">No se encontraron tickets para mostrar</div>';
}

function generarTablaHTML($result) {
    echo '<div class="table-responsive">';
    echo '<table id="tablaAjusteTickets" class="table table-bordered table-striped table-hover">';
    echo '<thead class="thead-dark">';
    echo '<tr>';
    echo '<th>Folio</th>';
    echo '<th>Sucursal</th>';
    echo '<th>Fecha</th>';
    echo '<th>Total</th>';
    echo '<th>Formas de Pago</th>';
    echo '<th>Vendedor</th>';
    echo '<th>Productos</th>';
    echo '<th>Acciones</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    while ($row = $result->fetch_assoc()) {
        $folioTicket = $row['Folio_Ticket'];
        $folioSucursal = $row['FolioSucursal'];
        $fecha = date('d/m/Y H:i', strtotime($row['Fecha_venta']));
        $total = number_format($row['Total_VentaG'], 2);
        $formasPago = mostrarFormasPago($row['FormaDePago']);
        $vendedor = $row['AgregadoPor'];
        $productos = $row['productos_ticket'];
        
        // Determinar si tiene múltiples formas de pago
        $tieneMultiplesPagos = strpos($row['FormaDePago'], '|') !== false;
        $badgeClass = $tieneMultiplesPagos ? 'badge-success' : 'badge-primary';
        $badgeText = $tieneMultiplesPagos ? 'Múltiples' : 'Simple';
        
        echo '<tr>';
        echo '<td><strong>' . $folioTicket . '</strong></td>';
        echo '<td>' . $row['Nombre_Sucursal'] . '</td>';
        echo '<td>' . $fecha . '</td>';
        echo '<td><strong>$' . $total . '</strong></td>';
        echo '<td>' . $formasPago . '</td>';
        echo '<td>' . $vendedor . '</td>';
        echo '<td><span class="badge badge-info">' . $productos . '</span></td>';
        echo '<td>';
        echo '<div class="btn-group" role="group">';
        echo '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        echo '<i class="fas fa-cog"></i> Acciones';
        echo '</button>';
        echo '<div class="dropdown-menu">';
        echo '<a class="dropdown-item btn-ajuste-formas-pago" href="#" data-id="' . $folioTicket . '-' . $folioSucursal . '">';
        echo '<i class="fas fa-credit-card text-primary"></i> Ajustar Formas de Pago';
        echo '</a>';
        echo '<a class="dropdown-item btn-desglose" href="#" data-id="' . $folioTicket . '-' . $folioSucursal . '">';
        echo '<i class="fas fa-list text-info"></i> Ver Desglose';
        echo '</a>';
        echo '<a class="dropdown-item btn-Reimpresion" href="#" data-id="' . $folioTicket . '-' . $folioSucursal . '">';
        echo '<i class="fas fa-print text-success"></i> Reimprimir';
        echo '</a>';
        echo '<a class="dropdown-item btn-EditarData" href="#" data-id="' . $folioTicket . '-' . $folioSucursal . '">';
        echo '<i class="fas fa-edit text-warning"></i> Editar Datos';
        echo '</a>';
        echo '</div>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
?>
