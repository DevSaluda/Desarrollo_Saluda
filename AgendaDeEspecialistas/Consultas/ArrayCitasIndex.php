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

$sql = "SELECT AgendaCitas_EspecialistasExt.ID_Agenda_Especialista, AgendaCitas_EspecialistasExt.Fk_Especialidad, 
AgendaCitas_EspecialistasExt.Fk_Especialista, AgendaCitas_EspecialistasExt.Fk_Sucursal, 
AgendaCitas_EspecialistasExt.Fecha, AgendaCitas_EspecialistasExt.Hora, AgendaCitas_EspecialistasExt.AgendadoPor, 
AgendaCitas_EspecialistasExt.Fecha_Hora, AgendaCitas_EspecialistasExt.Nombre_Paciente, 
AgendaCitas_EspecialistasExt.Telefono, AgendaCitas_EspecialistasExt.Tipo_Consulta, 
AgendaCitas_EspecialistasExt.Observaciones, AgendaCitas_EspecialistasExt.ID_H_O_D, 
Especialidades_Express.ID_Especialidad, Especialidades_Express.Nombre_Especialidad, 
Personal_Medico_Express.Medico_ID, Personal_Medico_Express.Nombre_Apellidos, 
Fechas_EspecialistasExt.ID_Fecha_Esp, Fechas_EspecialistasExt.Fecha_Disponibilidad, 
Horarios_Citas_Ext.ID_Horario, Horarios_Citas_Ext.Horario_Disponibilidad, 
SucursalesCorre.ID_SucursalC, SucursalesCorre.Nombre_Sucursal, SucursalesCorre.LinkMaps 
FROM AgendaCitas_EspecialistasExt
INNER JOIN Especialidades_Express ON AgendaCitas_EspecialistasExt.Fk_Especialidad = Especialidades_Express.ID_Especialidad
INNER JOIN Personal_Medico_Express ON AgendaCitas_EspecialistasExt.Fk_Especialista = Personal_Medico_Express.Medico_ID
INNER JOIN SucursalesCorre ON AgendaCitas_EspecialistasExt.Fk_Sucursal = SucursalesCorre.ID_SucursalC
INNER JOIN Fechas_EspecialistasExt ON AgendaCitas_EspecialistasExt.Fecha = Fechas_EspecialistasExt.ID_Fecha_Esp
INNER JOIN Horarios_Citas_Ext ON AgendaCitas_EspecialistasExt.Hora = Horarios_Citas_Ext.ID_Horario
WHERE Personal_Medico_Express.Nombre_Apellidos = '" . mysqli_real_escape_string($conn, $nombre_medico) . "'";
$result = mysqli_query($conn, $sql);

// Inicializar el array $data para evitar errores si no hay resultados
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

        // Generar el mensaje base de WhatsApp
        $whatsappMessage = "Hola, {$fila["Nombre_Paciente"]}! Te contactamos de *Saluda Centro Médico Familiar* para confirmar tu cita {$fila["Tipo_Consulta"]} agendada para el día *$fechaFormateada* en horario de *$horaFormateada* en nuestro centro médico de {$fila["Nombre_Sucursal"]}.";
        if (!empty($fila["LinkMaps"])) {
            $whatsappMessage .= " Puedes ver la ubicación de la sucursal aquí: {$fila["LinkMaps"]}.";
        }
        $whatsappMessage .= " Esperamos tu confirmación ☺️";
        $data[$c]["ConWhatsapp"] = "<a class='btn btn-success' href='https://api.whatsapp.com/send?phone=+52{$fila["Telefono"]}&text=" . urlencode($whatsappMessage) . "' target='_blank'><span class='fab fa-whatsapp'></span><span class='hidden-xs'></span></a>";
        $c++;
    }
} else {
    // Si hay error en la consulta, devuelve un JSON vacío
    $data = array();
}

$results = [
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
];

echo json_encode($results);
?>