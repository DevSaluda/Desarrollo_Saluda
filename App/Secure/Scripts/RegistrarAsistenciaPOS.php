<?php
// Script para registrar asistencia POS con validación de IP
// Requiere: $_POST['ip_publica'], $_POST['tipo_asistencia']

// Conexión a la base de datos
require_once '../db_connect.php';

session_start();

// Validar que el usuario esté logueado (ajusta el nombre de la variable de sesión según tu sistema)
if (!isset($_SESSION['user_id'])) {
    echo 'Sesión no válida.';
    exit;
}

$user_id = $_SESSION['user_id'];
$ip_publica = isset($_POST['ip_publica']) ? $_POST['ip_publica'] : '';
$tipo_asistencia = isset($_POST['tipo_asistencia']) ? $_POST['tipo_asistencia'] : '';

// Obtener sucursal del usuario (ajusta esta consulta según tu estructura)
$sqlSucursal = "SELECT id_sucursal FROM PersonalPOS WHERE id_personal = ? LIMIT 1";
$stmtSucursal = $conn->prepare($sqlSucursal);
$stmtSucursal->bind_param('i', $user_id);
$stmtSucursal->execute();
$stmtSucursal->bind_result($id_sucursal);
$stmtSucursal->fetch();
$stmtSucursal->close();

if (!$id_sucursal) {
    echo 'No se pudo determinar la sucursal.';
    exit;
}

// Validar IP autorizada
$sqlIP = "SELECT COUNT(*) FROM IPsAutorizadas WHERE id_sucursal = ? AND ip_autorizada = ? AND activa = 1";
$stmtIP = $conn->prepare($sqlIP);
$stmtIP->bind_param('is', $id_sucursal, $ip_publica);
$stmtIP->execute();
$stmtIP->bind_result($ip_valida);
$stmtIP->fetch();
$stmtIP->close();

if ($ip_valida < 1) {
    echo 'No puedes registrar asistencia fuera de la red autorizada.';
    exit;
}

// Registrar la asistencia (ajusta la tabla y campos según tu sistema)
$sqlInsert = "INSERT INTO RegistroAsistenciaPOS (id_personal, tipo_registro, fecha_hora, ip_registro) VALUES (?, ?, NOW(), ?)";
$stmtInsert = $conn->prepare($sqlInsert);
$stmtInsert->bind_param('iss', $user_id, $tipo_asistencia, $ip_publica);
if ($stmtInsert->execute()) {
    echo 'Asistencia registrada correctamente.';
} else {
    echo 'Error al registrar asistencia.';
}
$stmtInsert->close();
$conn->close();
