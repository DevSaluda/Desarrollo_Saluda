<?php
// Desarrollo_Saluda/AdminPOS/Consultas/ConsultaAjusteTickets.php
include "db_connection.php";
include "FuncionesFormasPago.php";

$accion = isset($_POST['accion']) ? $_POST['accion'] : '';

switch ($accion) {
    case 'cargar_tabla':
        cargarTablaAjusteTickets();
        break;
    case 'filtrar_sucursal':
        filtrarPorSucursal($_POST['sucursal']);
        break;
    case 'filtrar_fechas':
        filtrarPorFechas($_POST['fechaInicio'], $_POST['fechaFin']);
        break;
    case 'filtrar_forma_pago':
        $tipoFiltro = isset($_POST['tipoFiltro']) ? $_POST['tipoFiltro'] : 'contiene';
        filtrarPorFormaPago($_POST['formaPago'], $tipoFiltro);
        break;
    case 'estadisticas':
        obtenerEstadisticas();
        break;
    default:
        cargarTablaAjusteTickets();
        break;
}

function cargarTablaAjusteTickets() {
    global $conn;
    
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
    
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        generarTablaHTML($result);
    } else {
        echo '<div class="alert alert-info">No se encontraron tickets para mostrar</div>';
    }
}

function filtrarPorSucursal($sucursal) {
    global $conn;
    
    $whereSucursal = $sucursal ? "AND v.Fk_sucursal = '$sucursal'" : "";
    
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
            $whereSucursal
            GROUP BY v.Folio_Ticket, v.FolioSucursal, v.Fecha_venta, v.Total_VentaG, v.FormaDePago, v.CantidadPago, v.Pagos_tarjeta, v.AgregadoPor, s.Nombre_Sucursal
            ORDER BY v.Fecha_venta DESC, v.Folio_Ticket DESC
            LIMIT 100";
    
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        generarTablaHTML($result);
    } else {
        echo '<div class="alert alert-info">No se encontraron tickets para la sucursal seleccionada</div>';
    }
}

function filtrarPorFechas($fechaInicio, $fechaFin) {
    global $conn;
    
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
            WHERE v.Fecha_venta BETWEEN '$fechaInicio' AND '$fechaFin'
            GROUP BY v.Folio_Ticket, v.FolioSucursal, v.Fecha_venta, v.Total_VentaG, v.FormaDePago, v.CantidadPago, v.Pagos_tarjeta, v.AgregadoPor, s.Nombre_Sucursal
            ORDER BY v.Fecha_venta DESC, v.Folio_Ticket DESC
            LIMIT 100";
    
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        generarTablaHTML($result);
    } else {
        echo '<div class="alert alert-info">No se encontraron tickets para el rango de fechas seleccionado</div>';
    }
}

function filtrarPorFormaPago($formaPago, $tipoFiltro = 'contiene') {
    global $conn;
    
    $whereClause = "";
    
    switch ($tipoFiltro) {
        case 'contiene':
            $whereClause = $formaPago ? "v.FormaDePago LIKE '%$formaPago%'" : "1=1";
            break;
        case 'solo':
            $whereClause = $formaPago ? "v.FormaDePago = '$formaPago'" : "1=1";
            break;
        case 'multiples':
            $whereClause = "v.FormaDePago LIKE '%|%'";
            break;
        case 'simples':
            $whereClause = "v.FormaDePago NOT LIKE '%|%' AND v.FormaDePago NOT LIKE '%:%'";
            break;
        default:
            $whereClause = $formaPago ? "v.FormaDePago LIKE '%$formaPago%'" : "1=1";
            break;
    }
    
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
            WHERE $whereClause
            AND v.Fecha_venta >= DATE_SUB(NOW(), INTERVAL 30 DAY)
            GROUP BY v.Folio_Ticket, v.FolioSucursal, v.Fecha_venta, v.Total_VentaG, v.FormaDePago, v.CantidadPago, v.Pagos_tarjeta, v.AgregadoPor, s.Nombre_Sucursal
            ORDER BY v.Fecha_venta DESC, v.Folio_Ticket DESC
            LIMIT 100";
    
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        generarTablaHTML($result);
    } else {
        echo '<div class="alert alert-info">No se encontraron tickets con los criterios seleccionados</div>';
    }
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

function obtenerEstadisticas() {
    global $conn;
    
    $sql = "SELECT 
                COUNT(DISTINCT CONCAT(Folio_Ticket, '-', FolioSucursal)) as totalTickets,
                COUNT(DISTINCT CASE WHEN FormaDePago LIKE '%|%' THEN CONCAT(Folio_Ticket, '-', FolioSucursal) END) as multiplesPagos,
                SUM(Total_VentaG) as totalVendido
            FROM Ventas_POS 
            WHERE Fecha_venta >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
    
    $result = $conn->query($sql);
    $stats = $result->fetch_assoc();
    
    $stats['ultimaActualizacion'] = date('H:i:s');
    
    echo json_encode($stats);
}
?>
