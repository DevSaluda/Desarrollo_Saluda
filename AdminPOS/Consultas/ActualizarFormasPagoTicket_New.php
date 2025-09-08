<?php
/**
 * ActualizarFormasPagoTicket_New.php
 * Script robusto para actualizar formas de pago con seguridad
 */

// Configuración de seguridad
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Validar sesión activa
session_start();
if (!isset($_SESSION['usuario']) || !isset($_SESSION['empresa'])) {
    echo json_encode(['success' => false, 'message' => 'Sesión no válida']);
    exit;
}

// Configurar headers para JSON
header('Content-Type: application/json');

// Validar token de seguridad
$tokenRecibido = isset($_POST['tokenSeguridad']) ? $_POST['tokenSeguridad'] : '';
$tokenSesion = isset($_SESSION['token_formas_pago']) ? $_SESSION['token_formas_pago'] : '';

if (empty($tokenRecibido) || $tokenRecibido !== $tokenSesion) {
    echo json_encode(['success' => false, 'message' => 'Token de seguridad inválido']);
    exit;
}

// Validar datos de entrada
$folioTicket = isset($_POST["folioTicket"]) ? trim($_POST["folioTicket"]) : '';
$folioSucursal = isset($_POST["folioSucursal"]) ? trim($_POST["folioSucursal"]) : '';
$formaPago1 = isset($_POST["formaPago1"]) ? trim($_POST["formaPago1"]) : '';
$montoPago1 = isset($_POST["montoPago1"]) ? floatval($_POST["montoPago1"]) : 0;
$formaPago2 = isset($_POST["formaPago2"]) ? trim($_POST["formaPago2"]) : '';
$montoPago2 = isset($_POST["montoPago2"]) ? floatval($_POST["montoPago2"]) : 0;
$observaciones = isset($_POST["observaciones"]) ? trim($_POST["observaciones"]) : '';

// Validaciones básicas
if (empty($folioTicket) || empty($folioSucursal) || empty($formaPago1) || $montoPago1 <= 0) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos o inválidos']);
    exit;
}

// Validar formato de folio
if (!preg_match('/^[A-Z0-9]+$/', $folioTicket) || !preg_match('/^[A-Z0-9]+$/', $folioSucursal)) {
    echo json_encode(['success' => false, 'message' => 'Formato de folio inválido']);
    exit;
}

// Validar formas de pago
$formasValidas = ['Efectivo', 'Tarjeta', 'Transferencia', 'Cheque'];
if (!in_array($formaPago1, $formasValidas)) {
    echo json_encode(['success' => false, 'message' => 'Forma de pago 1 inválida']);
    exit;
}

if (!empty($formaPago2) && !in_array($formaPago2, $formasValidas)) {
    echo json_encode(['success' => false, 'message' => 'Forma de pago 2 inválida']);
    exit;
}

// Validar que las formas de pago sean diferentes
if (!empty($formaPago2) && $formaPago1 === $formaPago2) {
    echo json_encode(['success' => false, 'message' => 'Las formas de pago deben ser diferentes']);
    exit;
}

// Incluir conexión a base de datos
$adminPosPath = dirname(__DIR__);
include $adminPosPath . "/Consultas/db_connection.php";

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
    exit;
}

// Iniciar transacción
$conn->autocommit(false);

try {
    // Verificar que el ticket existe y obtener datos actuales
    $sqlVerificar = "SELECT * FROM Ventas_POS WHERE Folio_Ticket = ? AND FolioSucursal = ? LIMIT 1";
    $stmtVerificar = $conn->prepare($sqlVerificar);
    $stmtVerificar->bind_param("ss", $folioTicket, $folioSucursal);
    $stmtVerificar->execute();
    $resultVerificar = $stmtVerificar->get_result();
    
    if ($resultVerificar->num_rows == 0) {
        throw new Exception('Ticket no encontrado');
    }
    
    $ticketActual = $resultVerificar->fetch_assoc();
    $stmtVerificar->close();
    
    // Validar que la suma de pagos coincida con el total
    $totalPagos = $montoPago1 + $montoPago2;
    $diferencia = abs($totalPagos - $ticketActual['Total_VentaG']);
    
    if ($diferencia > 0.01) {
        throw new Exception('La suma de los pagos debe coincidir exactamente con el total del ticket');
    }
    
    // Construir nueva cadena de formas de pago
    $nuevaFormaPago = $formaPago1 . ':' . number_format($montoPago1, 2);
    if (!empty($formaPago2) && $montoPago2 > 0) {
        $nuevaFormaPago .= '|' . $formaPago2 . ':' . number_format($montoPago2, 2);
    }
    
    // Determinar valores para CantidadPago y Pagos_tarjeta
    $nuevaCantidadPago = $montoPago1;
    $nuevosPagosTarjeta = 0;
    
    if ($formaPago1 === 'Tarjeta') {
        $nuevosPagosTarjeta = $montoPago1;
    }
    
    if (!empty($formaPago2) && $formaPago2 === 'Tarjeta') {
        $nuevosPagosTarjeta += $montoPago2;
    }
    
    // Actualizar el ticket
    $sqlActualizar = "UPDATE Ventas_POS SET 
                      FormaDePago = ?, 
                      CantidadPago = ?, 
                      Pagos_tarjeta = ?,
                      Fecha_actualizacion = NOW()
                      WHERE Folio_Ticket = ? AND FolioSucursal = ?";
    
    $stmtActualizar = $conn->prepare($sqlActualizar);
    $stmtActualizar->bind_param("sdds", $nuevaFormaPago, $nuevaCantidadPago, $nuevosPagosTarjeta, $folioTicket, $folioSucursal);
    
    if (!$stmtActualizar->execute()) {
        throw new Exception('Error al actualizar el ticket: ' . $stmtActualizar->error);
    }
    
    $stmtActualizar->close();
    
    // Registrar en log de auditoría
    $usuario = $_SESSION['usuario'];
    $empresa = $_SESSION['empresa'];
    $tipoLog = 'EDICION_FORMAS_PAGO';
    $sistema = 'AdminPOS';
    
    $sqlLog = "INSERT INTO Logs_Sistema (Usuario, Tipo_log, Sistema, ID_H_O_D) VALUES (?, ?, ?, ?)";
    $stmtLog = $conn->prepare($sqlLog);
    $stmtLog->bind_param("ssss", $usuario, $tipoLog, $sistema, $empresa);
    
    if (!$stmtLog->execute()) {
        // No fallar por error en el log, solo registrar
        error_log("Error al registrar log de auditoría: " . $stmtLog->error);
    }
    
    $stmtLog->close();
    
    // Confirmar transacción
    $conn->commit();
    
    // Limpiar token de seguridad
    unset($_SESSION['token_formas_pago']);
    
    // Respuesta exitosa
    echo json_encode([
        'success' => true,
        'message' => 'Formas de pago actualizadas correctamente',
        'data' => [
            'folioTicket' => $folioTicket,
            'folioSucursal' => $folioSucursal,
            'nuevaFormaPago' => $nuevaFormaPago,
            'totalPagos' => $totalPagos,
            'timestamp' => date('Y-m-d H:i:s')
        ]
    ]);
    
} catch (Exception $e) {
    // Revertir transacción en caso de error
    $conn->rollback();
    
    // Log del error
    error_log("Error en ActualizarFormasPagoTicket_New.php: " . $e->getMessage());
    
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} finally {
    // Restaurar autocommit
    $conn->autocommit(true);
}
?>
