<?php
// Desarrollo_Saluda/AdminPOS/Consultas/ActualizarFormasPagoTicket_Simple.php
// Versión simplificada sin dependencia de tabla de logs

include "db_connection.php";

// Configurar respuesta JSON
header('Content-Type: application/json');

try {
    // Validar datos recibidos
    $folioTicket = isset($_POST['folioTicket']) ? trim($_POST['folioTicket']) : '';
    $folioSucursal = isset($_POST['folioSucursal']) ? trim($_POST['folioSucursal']) : '';
    $formaPago1 = isset($_POST['formaPago1']) ? trim($_POST['formaPago1']) : '';
    $montoPago1 = isset($_POST['montoPago1']) ? floatval($_POST['montoPago1']) : 0;
    $formaPago2 = isset($_POST['formaPago2']) ? trim($_POST['formaPago2']) : '';
    $montoPago2 = isset($_POST['montoPago2']) ? floatval($_POST['montoPago2']) : 0;
    $observaciones = isset($_POST['observaciones']) ? trim($_POST['observaciones']) : '';

    // Validaciones básicas
    if (empty($folioTicket) || empty($folioSucursal)) {
        throw new Exception('Datos del ticket incompletos');
    }

    if (empty($formaPago1) || $montoPago1 <= 0) {
        throw new Exception('Primera forma de pago es requerida');
    }

    // Verificar que el ticket existe
    $sql = "SELECT * FROM Ventas_POS 
            WHERE Folio_Ticket = '$folioTicket' 
            AND FolioSucursal = '$folioSucursal' 
            LIMIT 1";
    
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        throw new Exception('Ticket no encontrado');
    }

    $ticket = $result->fetch_assoc();

    // Validar que el total coincida
    $totalPagado = $montoPago1 + $montoPago2;
    if (abs($ticket['Total_VentaG'] - $totalPagado) > 0.01) {
        throw new Exception('El total pagado no coincide con el total del ticket');
    }

    // Crear la cadena de formas de pago
    if (!empty($formaPago2) && $montoPago2 > 0) {
        $formasPago = "$formaPago1:$montoPago1|$formaPago2:$montoPago2";
        $cantidadPago = $montoPago1;
        $pagosTarjeta = $montoPago2;
    } else {
        $formasPago = "$formaPago1:$montoPago1";
        $cantidadPago = $montoPago1;
        $pagosTarjeta = 0;
    }

    // Actualizar el registro
    $sql = "UPDATE Ventas_POS SET 
            FormaDePago = '$formasPago',
            CantidadPago = '$cantidadPago',
            Pagos_tarjeta = '$pagosTarjeta'
            WHERE Folio_Ticket = '$folioTicket' 
            AND FolioSucursal = '$folioSucursal'";

    if ($conn->query($sql)) {
        // Registrar en log de auditoría (opcional, no crítico)
        try {
            $usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Sistema';
            $empresa = isset($_SESSION['empresa']) ? $_SESSION['empresa'] : 'Saluda';
            $descripcion = "Formas de pago modificadas para ticket $folioTicket. ";
            $descripcion .= "Formas: $formaPago1 ($" . number_format($montoPago1, 2) . ")";
            if (!empty($formaPago2) && $montoPago2 > 0) {
                $descripcion .= " + $formaPago2 ($" . number_format($montoPago2, 2) . ")";
            }
            if (!empty($observaciones)) {
                $descripcion .= " - Observaciones: $observaciones";
            }

            // Intentar insertar en logs, pero no fallar si no funciona
            $logSql = "INSERT INTO Logs_Sistema (Descripcion, Usuario, Fecha, ID_H_O_D) 
                       VALUES ('$descripcion', '$usuario', NOW(), '$empresa')";
            $conn->query($logSql);
        } catch (Exception $logError) {
            // No fallar por error en el log
            error_log("Error al registrar log de auditoría: " . $logError->getMessage());
        }
        
        echo json_encode([
            'success' => true, 
            'message' => 'Formas de pago actualizadas correctamente',
            'data' => [
                'folioTicket' => $folioTicket,
                'formasPago' => $formasPago,
                'totalPagado' => $totalPagado
            ]
        ]);
    } else {
        throw new Exception('Error al actualizar: ' . $conn->error);
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => $e->getMessage()
    ]);
}
?>
