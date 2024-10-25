<?php
include 'db_connection.php'; // Asegúrate de tener la conexión a la base de datos



$especialista = $_POST['especialista'] ?? '';
$sucursal = $_POST['sucursal'] ?? '';

$sql = "SELECT
            AgendaCitas_EspecialistasExt.ID_Agenda_Especialista,
            Especialidades_Express.Nombre_Especialidad,
            Personal_Medico_Express.Nombre_Apellidos,
            SucursalesCorre.Nombre_Sucursal,
            Fechas_EspecialistasExt.Fecha_Disponibilidad,
            Horarios_Citas_Ext.Horario_Disponibilidad,
            AgendaCitas_EspecialistasExt.Nombre_Paciente,
            AgendaCitas_EspecialistasExt.Fecha_Hora,
            AgendaCitas_EspecialistasExt.Observaciones,
            AgendaCitas_EspecialistasExt.Tipo_Consulta
        FROM
            AgendaCitas_EspecialistasExt
            LEFT JOIN Especialidades_Express ON AgendaCitas_EspecialistasExt.Fk_Especialidad = Especialidades_Express.ID_Especialidad
            LEFT JOIN Personal_Medico_Express ON AgendaCitas_EspecialistasExt.Fk_Especialista = Personal_Medico_Express.Medico_ID
            LEFT JOIN SucursalesCorre ON AgendaCitas_EspecialistasExt.Fk_Sucursal = SucursalesCorre.ID_SucursalC
            LEFT JOIN Fechas_EspecialistasExt ON AgendaCitas_EspecialistasExt.Fecha = Fechas_EspecialistasExt.ID_Fecha_Esp
            LEFT JOIN Horarios_Citas_Ext ON AgendaCitas_EspecialistasExt.Hora = Horarios_Citas_Ext.ID_Horario
        WHERE
            YEAR(AgendaCitas_EspecialistasExt.Fecha_Hora) = YEAR(CURDATE())";

// Agregar filtro de especialista y sucursal
if (!empty($especialista)) {
    $sql .= " AND Personal_Medico_Express.Medico_ID = '$especialista'";
}
if (!empty($sucursal)) {
    $sql .= " AND SucursalesCorre.ID_SucursalC = '$sucursal'";
}

$result = $conn->query($sql);
$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = [
        'title' => $row['Nombre_Especialidad'] . ' - ' . $row['Nombre_Paciente'],
        'start' => $row['Fecha_Hora'],
        'nombrePaciente' => $row['Nombre_Paciente'],
        'nombreSucursal' => $row['Nombre_Sucursal'],
        'observaciones' => $row['Observaciones']
    ];
}

header('Content-Type: application/json');
echo json_encode($events);
?>
