<?php
// Desarrollo_Saluda/AdminPOS/Consultas/FuncionesFormasPago.php

/**
 * Función para parsear las formas de pago almacenadas en la base de datos
 * @param string $formasPagoString - Cadena con las formas de pago
 * @return array - Array con las formas de pago parseadas
 */
function parsearFormasPago($formasPagoString) {
    $formas = [];
    
    if (empty($formasPagoString)) {
        return $formas;
    }
    
    if (strpos($formasPagoString, '|') !== false) {
        // Múltiples formas de pago separadas por |
        $partes = explode('|', $formasPagoString);
        foreach ($partes as $parte) {
            if (strpos($parte, ':') !== false) {
                list($forma, $monto) = explode(':', $parte, 2);
                $formas[] = [
                    'forma' => trim($forma), 
                    'monto' => floatval(trim($monto))
                ];
            }
        }
    } else if (strpos($formasPagoString, ':') !== false) {
        // Una forma de pago con monto
        list($forma, $monto) = explode(':', $formasPagoString, 2);
        $formas[] = [
            'forma' => trim($forma), 
            'monto' => floatval(trim($monto))
        ];
    } else {
        // Forma de pago tradicional (sin monto específico)
        $formas[] = [
            'forma' => trim($formasPagoString), 
            'monto' => null
        ];
    }
    
    return $formas;
}

/**
 * Función para mostrar las formas de pago en HTML
 * @param string $formasPagoString - Cadena con las formas de pago
 * @return string - HTML con las formas de pago
 */
function mostrarFormasPago($formasPagoString) {
    $formas = parsearFormasPago($formasPagoString);
    
    if (empty($formas)) {
        return '<span class="text-muted">Sin información</span>';
    }
    
    $html = '<ul class="list-unstyled mb-0">';
    foreach ($formas as $forma) {
        $monto = $forma['monto'] !== null ? '$' . number_format($forma['monto'], 2) : '';
        $html .= "<li><strong>{$forma['forma']}</strong> $monto</li>";
    }
    $html .= '</ul>';
    
    return $html;
}

/**
 * Función para obtener el total pagado de las formas de pago
 * @param string $formasPagoString - Cadena con las formas de pago
 * @return float - Total pagado
 */
function obtenerTotalPagado($formasPagoString) {
    $formas = parsearFormasPago($formasPagoString);
    $total = 0;
    
    foreach ($formas as $forma) {
        if ($forma['monto'] !== null) {
            $total += $forma['monto'];
        }
    }
    
    return $total;
}

/**
 * Función para validar si las formas de pago son válidas
 * @param string $formasPagoString - Cadena con las formas de pago
 * @param float $totalTicket - Total del ticket
 * @return array - Array con resultado de validación
 */
function validarFormasPago($formasPagoString, $totalTicket) {
    $formas = parsearFormasPago($formasPagoString);
    $totalPagado = obtenerTotalPagado($formasPagoString);
    $diferencia = abs($totalTicket - $totalPagado);
    
    return [
        'valido' => $diferencia < 0.01,
        'totalPagado' => $totalPagado,
        'diferencia' => $diferencia,
        'formas' => $formas
    ];
}

/**
 * Función para crear la cadena de formas de pago para almacenar
 * @param array $formasPago - Array con las formas de pago
 * @return string - Cadena formateada para almacenar
 */
function crearCadenaFormasPago($formasPago) {
    $partes = [];
    
    foreach ($formasPago as $forma) {
        if (!empty($forma['forma']) && $forma['monto'] > 0) {
            $partes[] = $forma['forma'] . ':' . number_format($forma['monto'], 2, '.', '');
        }
    }
    
    return implode('|', $partes);
}

/**
 * Función para obtener las formas de pago disponibles
 * @return array - Array con las formas de pago disponibles
 */
function obtenerFormasPagoDisponibles() {
    return [
        'Efectivo' => 'Efectivo',
        'Tarjeta' => 'Tarjeta',
        'Transferencia' => 'Transferencia',
        'Cheque' => 'Cheque',
        'Credito' => 'Crédito',
        'Vale' => 'Vale'
    ];
}

/**
 * Función para generar el HTML del selector de formas de pago
 * @param string $name - Nombre del campo
 * @param string $selected - Valor seleccionado
 * @param bool $required - Si es requerido
 * @return string - HTML del selector
 */
function generarSelectorFormasPago($name, $selected = '', $required = false) {
    $formas = obtenerFormasPagoDisponibles();
    $requiredAttr = $required ? 'required' : '';
    
    $html = "<select name=\"$name\" class=\"form-control\" $requiredAttr>";
    $html .= '<option value="">Seleccionar forma de pago...</option>';
    
    foreach ($formas as $value => $label) {
        $selectedAttr = ($selected === $value) ? 'selected' : '';
        $html .= "<option value=\"$value\" $selectedAttr>$label</option>";
    }
    
    $html .= '</select>';
    
    return $html;
}

/**
 * Función para obtener estadísticas de formas de pago
 * @param string $fechaInicio - Fecha de inicio
 * @param string $fechaFin - Fecha de fin
 * @param int $sucursal - ID de sucursal (opcional)
 * @return array - Estadísticas de formas de pago
 */
function obtenerEstadisticasFormasPago($fechaInicio, $fechaFin, $sucursal = null) {
    global $conn;
    
    $whereSucursal = $sucursal ? "AND Fk_sucursal = $sucursal" : "";
    
    $sql = "SELECT FormaDePago, COUNT(*) as cantidad, SUM(Total_VentaG) as total
            FROM Ventas_POS 
            WHERE Fecha_venta BETWEEN '$fechaInicio' AND '$fechaFin' 
            $whereSucursal
            GROUP BY FormaDePago
            ORDER BY total DESC";
    
    $result = $conn->query($sql);
    $estadisticas = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $formas = parsearFormasPago($row['FormaDePago']);
            foreach ($formas as $forma) {
                $key = $forma['forma'];
                if (!isset($estadisticas[$key])) {
                    $estadisticas[$key] = [
                        'cantidad' => 0,
                        'total' => 0
                    ];
                }
                $estadisticas[$key]['cantidad'] += $row['cantidad'];
                $estadisticas[$key]['total'] += $forma['monto'] ?? $row['total'];
            }
        }
    }
    
    return $estadisticas;
}

/**
 * Función para exportar formas de pago a CSV
 * @param array $datos - Datos a exportar
 * @param string $filename - Nombre del archivo
 */
function exportarFormasPagoCSV($datos, $filename = 'formas_pago.csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);
    
    $output = fopen('php://output', 'w');
    
    // BOM para UTF-8
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    // Encabezados
    fputcsv($output, ['Forma de Pago', 'Cantidad', 'Total']);
    
    // Datos
    foreach ($datos as $forma => $stats) {
        fputcsv($output, [
            $forma,
            $stats['cantidad'],
            number_format($stats['total'], 2)
        ]);
    }
    
    fclose($output);
    exit;
}
?>
