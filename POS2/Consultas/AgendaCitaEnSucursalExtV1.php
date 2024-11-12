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

// Obtener el nombre de la sucursal desde SucursalesCorre2
$sql_sucursal = "SELECT Nombre_Sucursal FROM SucursalesCorre WHERE ID_SucursalC = '$Fk_Sucursal'";
$result_sucursal = mysqli_query($conn, $sql_sucursal);
$row_sucursal = mysqli_fetch_assoc($result_sucursal);
$Nombre_Sucursal = $row_sucursal['Nombre_Sucursal'];

// Obtener la fecha desde la tabla Fechas_EspecialistasExt
$sql_fecha = "SELECT Fecha_Disponibilidad FROM Fechas_EspecialistasExt WHERE ID_Fecha_Esp = '$Fk_Fecha' AND FK_Especialista = '$Fk_Especialista'";
$result_fecha = mysqli_query($conn, $sql_fecha);
$row_fecha = mysqli_fetch_assoc($result_fecha);
$Fecha = $row_fecha['Fecha_Disponibilidad'];

// Obtener la hora desde la tabla Horarios_Citas_Ext
$sql_hora = "SELECT Horario_Disponibilidad FROM Horarios_Citas_Ext WHERE ID_Horario = '$Fk_Hora' AND FK_Especialista = '$Fk_Especialista' AND FK_Fecha = '$Fk_Fecha'";
$result_hora = mysqli_query($conn, $sql_hora);
$row_hora = mysqli_fetch_assoc($result_hora);
$Hora = $row_hora['Horario_Disponibilidad'];

// Consultar el IDGoogleCalendar del especialista
$sql_calendar = "SELECT IDGoogleCalendar FROM Personal_Medico_Express WHERE Medico_ID = '$Fk_Especialista'";
$result_calendar = mysqli_query($conn, $sql_calendar);
$row_calendar = mysqli_fetch_assoc($result_calendar);
$calendarId = $row_calendar['IDGoogleCalendar'];

// Verificar si ya existe la cita
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
        if (!empty($calendarId)) {
            // Agregar el evento a Google Calendar
            $client = new Google_Client();
            $client->setAuthConfig('../../app-saluda-966447541c3c.json'); // Ruta al archivo JSON de credenciales
            $client->setScopes(Google_Service_Calendar::CALENDAR);
            $service = new Google_Service_Calendar($client);

            // Ajustar el formato de la hora y fecha para el formato ISO 8601
            $startDateTime = date('Y-m-d\TH:i:s', strtotime("$Fecha $Hora"));
            $HoraFin = date('H:i', strtotime($Hora) + 60 * 60); // Sumar 1 hora a la hora de inicio
            $endDateTime = date('Y-m-d\TH:i:s', strtotime("$Fecha $HoraFin"));

            try {
                $event = new Google_Service_Calendar_Event(array(
                    'summary' => "Consulta de $Nombre_Paciente",
                    'location' => "$Nombre_Sucursal", // Usar el nombre de la sucursal en lugar del Fk_Sucursal
                    'description' => "$Observaciones",
                    'start' => array(
                        'dateTime' => $startDateTime,
                        'timeZone' => 'America/Mexico_City',
                    ),
                    'end' => array(
                        'dateTime' => $endDateTime,
                        'timeZone' => 'America/Mexico_City',
                    ),
                    'colorId' => '3',
                ));

                $event = $service->events->insert($calendarId, $event);

                // Guardar el ID del evento de Google Calendar en la base de datos
                $GoogleEventId = $event->id;
                $sql_update = "UPDATE AgendaCitas_EspecialistasExt SET GoogleEventId = '$GoogleEventId' WHERE Fecha = '$Fk_Fecha' AND Hora='$Fk_Hora' AND IDGoogleCalendar = '$calendarId'";
                mysqli_query($conn, $sql_update);
                echo json_encode(array("statusCode" => 200, "eventLink" => $event->htmlLink));
            } catch (Exception $e) {
                echo json_encode(array("statusCode" => 400, "error" => $e->getMessage()));
            }
        } else {
            echo json_encode(array("statusCode" => 200, "message" => "Cita agendada sin Google Calendar"));
        }
    } else {
        echo json_encode(array("statusCode" => 201));
    }

    mysqli_close($conn);
}
?>
