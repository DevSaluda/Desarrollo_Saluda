<?php

include_once 'db_connection.php';
$Cita = "Agendado";
$ColorClaveCalendario = "#04B45F";

// Obtener datos del formulario
$Fk_Especialidad = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['EspecialidadExt']))));
$Fk_Especialista = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['MedicoExt']))));
$Fk_Sucursal = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalExt']))));
$Fecha = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaExt']))));
$Hora = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['HorasExt']))));
$Nombre_Paciente = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['NombresExt']))));
$Telefono = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['TelExt']))));
$Tipo_Consulta = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['TipoConsultaExt']))));
$Estatus_cita = $conn->real_escape_string(htmlentities(strip_tags(Trim($Cita))));
$Observaciones = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['ObservacionesExt']))));
$ID_H_O_D = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaExt']))));
$AgendadoPor = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['UsuarioExt']))));
$Sistema = $conn->real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaExt']))));
$Color_Calendario = $conn->real_escape_string(htmlentities(strip_tags(Trim($ColorClaveCalendario))));

// Realizar consulta para verificar si ya existe una cita con los mismos datos
$sql = "SELECT Fk_Especialidad, Fk_Especialista, Fk_Sucursal, Fecha, Hora, Nombre_Paciente, Telefono, Tipo_Consulta, ID_H_O_D  
        FROM AgendaCitas_EspecialistasExt 
        WHERE Fk_Especialidad='$Fk_Especialidad' AND Fk_Especialista='$Fk_Especialista' AND Fk_Sucursal='$Fk_Sucursal'
        AND Fecha='$Fecha' AND Hora='$Hora' AND Nombre_Paciente='$Nombre_Paciente' AND Telefono='$Telefono' 
        AND Tipo_Consulta='$Tipo_Consulta' AND ID_H_O_D='$ID_H_O_D'";

$resultset = mysqli_query($conn, $sql) or die("Error en la base de datos:" . mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);

// Verificar si ya existe una cita con los mismos datos
if ($row !== null) {
    echo json_encode(array("statusCode" => 250));
} else {
    // Si no existe, realizar la inserción en la base de datos
    $sql = "INSERT INTO `AgendaCitas_EspecialistasExt`(`Fk_Especialidad`, `Fk_Especialista`, `Fk_Sucursal`, `Fecha`, `Hora`,
            `Nombre_Paciente`, `Telefono`, `Tipo_Consulta`, `Estatus_cita`, `Observaciones`, `ID_H_O_D`, `AgendadoPor`, 
            `Sistema`,  `Color_Calendario`) 
            VALUES ('$Fk_Especialidad','$Fk_Especialista', '$Fk_Sucursal','$Fecha','$Hora',
            '$Nombre_Paciente','$Telefono','$Tipo_Consulta', '$Estatus_cita', '$Observaciones','$ID_H_O_D',
            '$AgendadoPor','$Sistema','$Color_Calendario')";

    if (mysqli_query($conn, $sql)) {
        // Actualizar el estado de la fecha y la hora a 'Ocupado'
        
        $sql_update_hora = "UPDATE Horarios_Citas_Ext SET Estado='Ocupado' WHERE ID_Horario='$Fk_Hora'";
        mysqli_query($conn, $sql_update_hora);
        // --- INICIO Google Calendar ---
        // Obtener el IDGoogleCalendar del especialista
        $sql_calendar = "SELECT IDGoogleCalendar FROM Personal_Medico_Express WHERE Medico_ID = '$Fk_Especialista'";
        $result_calendar = mysqli_query($conn, $sql_calendar);
        $row_calendar = mysqli_fetch_assoc($result_calendar);
        $calendarId = isset($row_calendar['IDGoogleCalendar']) ? $row_calendar['IDGoogleCalendar'] : '';

        if (!empty($calendarId)) {
            require_once __DIR__ . '/vendor/autoload.php';
            $client = new Google_Client();
            $client->setAuthConfig('../../app-saluda-966447541c3c.json');
            $client->setScopes(Google_Service_Calendar::CALENDAR);
            $service = new Google_Service_Calendar($client);

            // Obtener fecha y hora en formato correcto
            $sql_fecha = "SELECT Fecha_Disponibilidad FROM Fechas_EspecialistasExt WHERE ID_Fecha_Esp = '$Fecha' AND FK_Especialista = '$Fk_Especialista'";
            $result_fecha = mysqli_query($conn, $sql_fecha);
            $row_fecha = mysqli_fetch_assoc($result_fecha);
            $fechaISO = $row_fecha ? $row_fecha['Fecha_Disponibilidad'] : '';

            $sql_hora = "SELECT Horario_Disponibilidad FROM Horarios_Citas_Ext WHERE ID_Horario = '$Hora' AND FK_Especialista = '$Fk_Especialista' AND FK_Fecha = '$Fecha'";
            $result_hora = mysqli_query($conn, $sql_hora);
            $row_hora = mysqli_fetch_assoc($result_hora);
            $horaISO = $row_hora ? $row_hora['Horario_Disponibilidad'] : '';

            $startDateTime = date('Y-m-d\TH:i:s', strtotime("$fechaISO $horaISO"));
            $HoraFin = date('H:i', strtotime($horaISO) + 60 * 60);
            $endDateTime = date('Y-m-d\TH:i:s', strtotime("$fechaISO $HoraFin"));

            try {
                $event = new Google_Service_Calendar_Event(array(
                    'summary' => "Consulta de $Nombre_Paciente",
                    'location' => "$Fk_Sucursal",
                    'description' => "Motivo de Consulta: $Tipo_Consulta\nObservaciones: $Observaciones",
                    'start' => array(
                        'dateTime' => $startDateTime,
                        'timeZone' => 'America/Mexico_City',
                    ),
                    'end' => array(
                        'dateTime' => $endDateTime,
                        'timeZone' => 'America/Mexico_City',
                    ),
                    'colorId' => '2',
                ));
                $event = $service->events->insert($calendarId, $event);
                $GoogleEventId = $event->id;
                $sql_update = "UPDATE AgendaCitas_EspecialistasExt SET GoogleEventId = '$GoogleEventId' WHERE Fecha = '$Fecha' AND Hora='$Hora' AND IDGoogleCalendar = '$calendarId'";
                mysqli_query($conn, $sql_update);
                echo json_encode(array("statusCode" => 200, "eventLink" => $event->htmlLink));
            } catch (Exception $e) {
                echo json_encode(array("statusCode" => 400, "error" => $e->getMessage()));
            }
        } else {
            echo json_encode(array("statusCode" => 200, "message" => "Cita agendada sin Google Calendar"));
        }
        // --- FIN Google Calendar ---
    } else {
        echo json_encode(array("statusCode" => 201));
    }

    mysqli_close($conn);
}
?>
