<?php
// Desarrollo_Saluda/AdminPOS/Consultas/ActualizarFormasPagoTicket.php
include "db_connection.php";

// Configurar respuesta JSON
header('Content-Type: application/json');

try {
    // Validar datos recibidos
    $folioTicket = isset($_POST['folioTicket']) ? trim($_POST['folioTicket']) : '';
    $folioSucursal = isset($_POST['folioSucursal']) ? trim($_POST['folioSucursal']) : '';
    $totalTicket = isset($_POST['totalTicket']) ? floatval($_POST['totalTicket']) : 0;
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

    if ($totalTicket <= 0) {
        throw new Exception('Total del ticket inválido');
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

    // Validar formas de pago
    if (!empty($formaPago2) && $montoPago2 > 0) {
        if ($formaPago1 === $formaPago2) {
            throw new Exception('Las formas de pago deben ser diferentes');
        }
        if ($montoPago2 <= 0) {
            throw new Exception('El monto de la segunda forma de pago debe ser mayor a 0');
        }
    }

    // Crear la cadena de formas de pago
    if (!empty($formaPago2) && $montoPago2 > 0) {
        // Múltiples formas de pago
        $formasPago = "$formaPago1:$montoPago1|$formaPago2:$montoPago2";
        $cantidadPago = $montoPago1;
        $pagosTarjeta = $montoPago2;
    } else {
        // Una sola forma de pago
        $formasPago = "$formaPago1:$montoPago1";
        $cantidadPago = $montoPago1;
        $pagosTarjeta = 0;
    }

    // Escapar caracteres especiales para la consulta
    $formasPago = mysqli_real_escape_string($conn, $formasPago);
    $cantidadPago = mysqli_real_escape_string($conn, $cantidadPago);
    $pagosTarjeta = mysqli_real_escape_string($conn, $pagosTarjeta);
    $folioTicket = mysqli_real_escape_string($conn, $folioTicket);
    $folioSucursal = mysqli_real_escape_string($conn, $folioSucursal);

    // Iniciar transacción
    $conn->autocommit(false);

    // Actualizar el registro principal
    $sql = "UPDATE Ventas_POS SET 
            FormaDePago = '$formasPago',
            CantidadPago = '$cantidadPago',
            Pagos_tarjeta = '$pagosTarjeta'
            WHERE Folio_Ticket = '$folioTicket' 
            AND FolioSucursal = '$folioSucursal'";

    if (!$conn->query($sql)) {
        throw new Exception('Error al actualizar el ticket: ' . $conn->error);
    }

    // Registrar en log de auditoría
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

    // Verificar estructura de la tabla Logs_Sistema
    $checkColumns = "SHOW COLUMNS FROM Logs_Sistema";
    $columnsResult = $conn->query($checkColumns);
    $columns = [];
    while ($row = $columnsResult->fetch_assoc()) {
        $columns[] = $row['Field'];
    }
    
    // Construir la consulta de log según las columnas disponibles
    if (in_array('Accion', $columns)) {
        $logSql = "INSERT INTO Logs_Sistema (Accion, Descripcion, Usuario, Fecha, ID_H_O_D) 
                   VALUES ('EDICION_PAGO', '$descripcion', '$usuario', NOW(), '$empresa')";
    } else if (in_array('accion', $columns)) {
        $logSql = "INSERT INTO Logs_Sistema (accion, descripcion, usuario, fecha, id_h_o_d) 
                   VALUES ('EDICION_PAGO', '$descripcion', '$usuario', NOW(), '$empresa')";
    } else {
        // Si no hay columna Accion, usar solo las columnas básicas
        $logSql = "INSERT INTO Logs_Sistema (Descripcion, Usuario, Fecha, ID_H_O_D) 
                   VALUES ('$descripcion', '$usuario', NOW(), '$empresa')";
    }
    
    if (!$conn->query($logSql)) {
        // No fallar por error en el log, solo registrar
        error_log("Error al registrar log de auditoría: " . $conn->error);
    }

    // Confirmar transacción
    $conn->commit();
    $conn->autocommit(true);

    // Respuesta exitosa
    echo json_encode([
        'success' => true, 
        'message' => 'Formas de pago actualizadas correctamente',
        'data' => [
            'folioTicket' => $folioTicket,
            'formasPago' => $formasPago,
            'totalPagado' => $totalPagado
        ]
    ]);

} catch (Exception $e) {
    // Revertir transacción en caso de error
    if (!$conn->autocommit) {
        $conn->rollback();
        $conn->autocommit(true);
    }
    
    // Respuesta de error
    echo json_encode([
        'success' => false, 
        'message' => $e->getMessage()
    ]);
}

// Cerrar conexión
$conn->close();
?>
