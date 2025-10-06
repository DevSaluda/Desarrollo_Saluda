<?php
function fechaCastellano($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}

include("db_connection.php");
include "Consultas.php";

// Obtener parámetros de DataTables
$draw = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
$start = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;
$search = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

// Consulta optimizada con JOIN explícito y paginación
$sql1 = "SELECT SQL_CALC_FOUND_ROWS 
         a.Id_genda, a.Nombres_Apellidos, a.Telefono, a.Fk_sucursal,
         a.Medico, a.Fecha, a.Asistio, a.Turno, a.Motivo_Consulta,
         a.Agrego, a.AgregadoEl, s.ID_SucursalC, s.Nombre_Sucursal 
         FROM Agenda_revaloraciones a
         INNER JOIN SucursalesCorre s ON s.ID_SucursalC = a.Fk_sucursal";

// Agregar búsqueda si existe
if (!empty($search)) {
    $sql1 .= " WHERE a.Nombres_Apellidos LIKE ? OR a.Telefono LIKE ? OR s.Nombre_Sucursal LIKE ?";
    $searchParam = "%$search%";
}

// Agregar ordenamiento
$sql1 .= " ORDER BY a.Fecha DESC LIMIT ?, ?";

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($sql1);
if (!empty($search)) {
    $stmt->bind_param("sssii", $searchParam, $searchParam, $searchParam, $start, $length);
} else {
    $stmt->bind_param("ii", $start, $length);
}
$stmt->execute();
$query = $stmt->get_result();

// Obtener el total de registros
$totalRecords = $conn->query("SELECT FOUND_ROWS()")->fetch_row()[0];

// Preparar los datos para la respuesta
$data = array();
while ($row = $query->fetch_assoc()) {
    $data[] = array(
        $row['Id_genda'],
        $row['Nombres_Apellidos'],
        $row['Telefono'],
        fechaCastellano($row['Fecha']),
        $row['Nombre_Sucursal'],
        $row['Medico'],
        $row['Turno'],
        $row['Motivo_Consulta'],
        '<a class="btn btn-success" href="https://api.whatsapp.com/send?phone=+52' . $row['Telefono'] . '&text=¡Hola ' . $row['Nombres_Apellidos'] . '! Queremos recordarte lo importante que es darle seguimiento a tu salud. 👩🏻‍⚕🧑🏻‍⚕ Te invitamos a tu próxima revaloración, programada para el día *' . fechaCastellano($row['Fecha']) . '* en *Saluda Centro Médico Familiar ' . $row['Nombre_Sucursal'] . '*. ¿Confirmamos tu asistencia? Tu bienestar es nuestra prioridad. ¡Gracias por confiar tu salud con nosotros! 🩷" target="_blank"><span class="fab fa-whatsapp"></span><span class="hidden-xs"></span></a>',
        $row['Agrego'],
        fechaCastellano($row['AgregadoEl']),
        '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>
         <div class="dropdown-menu">
             <a data-id="' . $row['Id_genda'] . '" class="btn-Asiste dropdown-item">¿El paciente asistió? <i class="far fa-calendar-check"></i></a>
         </div>'
    );
}

// Preparar la respuesta JSON
$response = array(
    "draw" => $draw,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $data
);

// Enviar la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>
