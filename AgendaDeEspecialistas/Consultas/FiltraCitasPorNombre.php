<?php
session_start();
header('Content-Type: application/json');
include "db_connection.php";

$usuario = isset($_REQUEST['usuario']) ? trim($_REQUEST['usuario']) : '';
$busqueda = isset($_REQUEST['busqueda']) ? $conn->real_escape_string($_REQUEST['busqueda']) : '';

// Si no viene usuario, intenta obtenerlo de la sesión
if ($usuario === '') {
    $usuario = isset($_SESSION['Nombre_Medico']) ? $_SESSION['Nombre_Medico'] : '';
}

// Si sigue vacío, error
if ($usuario === '') {
    echo json_encode(['error' => 'No se especificó usuario']);
    exit;
}

// Obtener los Medico_ID asociados al usuario
$sql_ids = "SELECT Medico_ID FROM Personal_Medico_Express WHERE Nombre_Apellidos = '" . mysqli_real_escape_string($conn, $usuario) . "'";
$result_ids = $conn->query($sql_ids);
$ids_medicos = [];
while($row = $result_ids->fetch_assoc()) {
    $ids_medicos[] = $row['Medico_ID'];
}
if (empty($ids_medicos)) {
    echo json_encode(['error' => 'No hay médicos asociados al usuario', 'usuario' => $usuario]);
    exit;
}
$ids_string = implode(',', $ids_medicos);

// Construir el query
$sql = "SELECT 
        ace.ID_Agenda_Especialista,
        ace.Nombre_Paciente,
        ace.Telefono,
        ace.Tipo_Consulta,
        ace.Observaciones,
        ace.AgendadoPor,
        ace.Fecha_Hora,
        ee.Nombre_Especialidad,
        pme.Nombre_Apellidos,
        fe.Fecha_Disponibilidad,
        hce.Horario_Disponibilidad,
        sc.Nombre_Sucursal,
        sc.LinkMaps
        FROM AgendaCitas_EspecialistasExt ace
        INNER JOIN Especialidades_Express ee ON ace.Fk_Especialidad = ee.ID_Especialidad
        INNER JOIN Personal_Medico_Express pme ON ace.Fk_Especialista = pme.Medico_ID
        INNER JOIN SucursalesCorre sc ON ace.Fk_Sucursal = sc.ID_SucursalC
        INNER JOIN Fechas_EspecialistasExt fe ON ace.Fecha = fe.ID_Fecha_Esp
        INNER JOIN Horarios_Citas_Ext hce ON ace.Hora = hce.ID_Horario
        WHERE ace.Fk_Especialista IN ($ids_string)";

if ($busqueda !== '') {
    $sql .= " AND (ace.Nombre_Paciente LIKE '%$busqueda%' OR pme.Nombre_Apellidos LIKE '%$busqueda%')";
}

$sql .= " ORDER BY ace.Fecha_Hora DESC";

$result = $conn->query($sql);
$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = [
        'id' => $row['ID_Agenda_Especialista'],
        'title' => $row['Nombre_Paciente'],
        'telefono' => $row['Telefono'],
        'especialidad' => $row['Nombre_Especialidad'],
        'doctor' => $row['Nombre_Apellidos'],
        'sucursal' => $row['Nombre_Sucursal'],
        'observaciones' => $row['Observaciones'],
        'start' => $row['Fecha_Hora'],
        'end' => $row['Fecha_Hora'],
        'allDay' => false
    ];
}
echo json_encode($data);
?>