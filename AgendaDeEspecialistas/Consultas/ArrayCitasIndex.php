<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Obtener el nombre del médico logeado desde la sesión
$nombre_medico = isset($_SESSION['Nombre_Medico']) ? $_SESSION['Nombre_Medico'] : '';

function fechaCastellano ($fecha) {
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

// Primero obtenemos todos los Medico_ID que coincidan con el nombre
$sql_ids = "SELECT Medico_ID FROM Personal_Medico_Express 
            WHERE Nombre_Apellidos = '" . mysqli_real_escape_string($conn, $nombre_medico) . "'";
$result_ids = mysqli_query($conn, $sql_ids);

$ids_medicos = array();
while($row = mysqli_fetch_assoc($result_ids)) {
    $ids_medicos[] = $row['Medico_ID'];
}

// Si no encontramos médicos, devolvemos array vacío
if(empty($ids_medicos)) {
    echo json_encode([
        "sEcho" => 1,
        "iTotalRecords" => 0,
        "iTotalDisplayRecords" => 0,
        "aaData" => array()
    ]);
    exit;
}

// Construimos la condición IN para los IDs
$ids_string = implode(",", array_map('intval', $ids_medicos));

// Ahora la consulta principal con los IDs obtenidos
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
        WHERE ace.Fk_Especialista IN ($ids_string)
        AND fe.Fecha_Disponibilidad BETWEEN CURDATE() AND CURDATE() + INTERVAL 4 DAY";

$result = mysqli_query($conn, $sql);

$data = array();
$c = 0;

if ($result) {
    while($fila = $result->fetch_assoc()) {
        $data[$c]["Folio"] = $fila["ID_Agenda_Especialista"];
        $data[$c]["Paciente"] = $fila["Nombre_Paciente"];
        $data[$c]["Telefono"] = $fila["Telefono"];
        $data[$c]["Fecha"] = fechaCastellano($fila["Fecha_Disponibilidad"]);
        $data[$c]["Hora"] = date('h:i A', strtotime($fila["Horario_Disponibilidad"]));
        $data[$c]["Especialidad"] = $fila["Nombre_Especialidad"];
        $data[$c]["Doctor"] = $fila["Nombre_Apellidos"];
        $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
        $data[$c]["Tipo_Consulta"] = $fila["Tipo_Consulta"];
        $data[$c]["Observaciones"] = $fila["Observaciones"];
        $data[$c]["AgendadoPor"] = $fila["AgendadoPor"];
        $data[$c]["AgendamientoRealizado"] = $fila["Fecha_Hora"];

        $horaFormateada = date('h:i A', strtotime($fila["Horario_Disponibilidad"]));
        $fechaFormateada = fechaCastellano($fila["Fecha_Disponibilidad"]);

        $whatsappMessage = "Hola, {$fila["Nombre_Paciente"]}! Te contactamos de *Saluda Centro Médico Familiar* para confirmar tu cita {$fila["Tipo_Consulta"]} agendada para el día *$fechaFormateada* en horario de *$horaFormateada* en nuestro centro médico de {$fila["Nombre_Sucursal"]}.";
        if (!empty($fila["LinkMaps"])) {
            $whatsappMessage .= " Puedes ver la ubicación de la sucursal aquí: {$fila["LinkMaps"]}.";
        }
        $whatsappMessage .= " Esperamos tu confirmación ☺️";
        $data[$c]["ConWhatsapp"] = "<a class='btn btn-success' href='https://api.whatsapp.com/send?phone=+52{$fila["Telefono"]}&text=" . urlencode($whatsappMessage) . "' target='_blank'><span class='fab fa-whatsapp'></span><span class='hidden-xs'></span></a>";
        $c++;
    }
}

$results = [
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
];

echo json_encode($results);
?>