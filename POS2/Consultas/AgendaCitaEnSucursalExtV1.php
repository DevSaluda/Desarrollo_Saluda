<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error_log');

require '../vendor/autoload.php';
include_once 'db_connection.php';

// Debug: Verifica conexión
if (!$conn) {
    error_log("Conexión a BD fallida: " . mysqli_connect_error());
    die(json_encode(["statusCode" => 500, "error" => "Error de conexión a BD"]));
}

// Debug: Verifica datos POST
$post_keys = ['EspecialidadExt','MedicoExt','SucursalExt','FechaExt','HorasExt','NombresExt','TelExt','TipoConsultaExt','ObservacionesExt','EmpresaExt','UsuarioExt','SistemaExt'];
foreach ($post_keys as $key) {
    if (!isset($_POST[$key])) {
        error_log("Falta POST: $key");
        die(json_encode(["statusCode" => 500, "error" => "Falta POST: $key"]));
    }
}

// Configura la conexión a la base de datos para usar UTF-8
$conn->set_charset("utf8mb4");

$Cita = "Agendado";
$ColorClaveCalendario = "#04B45F";

$Fk_Especialidad = $conn->real_escape_string(trim($_POST['EspecialidadExt']));
$Fk_Especialista = $conn->real_escape_string(trim($_POST['MedicoExt']));
$Fk_Sucursal = $conn->real_escape_string(trim($_POST['SucursalExt']));
$Fk_Fecha = $conn->real_escape_string(trim($_POST['FechaExt'])); // ID de la fecha
$Fk_Hora = $conn->real_escape_string(trim($_POST['HorasExt']));  // ID de la hora
$Nombre_Paciente = $conn->real_escape_string(trim($_POST['NombresExt']));
$Telefono = $conn->real_escape_string(trim($_POST['TelExt']));
$Tipo_Consulta = $conn->real_escape_string(trim($_POST['TipoConsultaExt']));
$Estatus_cita = $conn->real_escape_string(trim($Cita));
$Observaciones = $conn->real_escape_string(trim($_POST['ObservacionesExt']));
$ID_H_O_D = $conn->real_escape_string(trim($_POST['EmpresaExt']));
$AgendadoPor = $conn->real_escape_string(trim($_POST['UsuarioExt']));
$Sistema = $conn->real_escape_string(trim($_POST['SistemaExt']));
$Color_Calendario = $conn->real_escape_string(trim($ColorClaveCalendario));

// Obtener el nombre de la sucursal desde SucursalesCorre
$sql_sucursal = "SELECT Nombre_Sucursal FROM SucursalesCorre WHERE ID_SucursalC = '$Fk_Sucursal'";
$result_sucursal = mysqli_query($conn, $sql_sucursal);
if (!$result_sucursal) {
    error_log("Error en consulta sucursal: " . mysqli_error($conn));
    die(json_encode(["statusCode" => 500, "error" => "Error en consulta sucursal"]));
}
$row_sucursal = mysqli_fetch_assoc($result_sucursal);
if (!$row_sucursal) {
    error_log("No se encontró sucursal con ID: $Fk_Sucursal");
    die(json_encode(["statusCode" => 404, "error" => "Sucursal no encontrada"]));
}
$Nombre_Sucursal = $row_sucursal['Nombre_Sucursal'];

// Obtener la fecha desde la tabla Fechas_EspecialistasExt
$sql_fecha = "SELECT Fecha_Disponibilidad FROM Fechas_EspecialistasExt WHERE ID_Fecha_Esp = '$Fk_Fecha' AND FK_Especialista = '$Fk_Especialista'";
$result_fecha = mysqli_query($conn, $sql_fecha);
if (!$result_fecha) {
    error_log("Error en consulta fecha: " . mysqli_error($conn));
    die(json_encode(["statusCode" => 500, "error" => "Error en consulta fecha"]));
}
$row_fecha = mysqli_fetch_assoc($result_fecha);
if (!$row_fecha) {
    error_log("No se encontró fecha con ID: $Fk_Fecha y especialista: $Fk_Especialista");
    die(json_encode(["statusCode" => 404, "error" => "Fecha no encontrada"]));
}
$Fecha = $row_fecha['Fecha_Disponibilidad'];

// Obtener la hora desde la tabla Horarios_Citas_Ext
$sql_hora = "SELECT Horario_Disponibilidad FROM Horarios_Citas_Ext WHERE ID_Horario = '$Fk_Hora' AND FK_Especialista = '$Fk_Especialista' AND FK_Fecha = '$Fk_Fecha'";
$result_hora = mysqli_query($conn, $sql_hora);
if (!$result_hora) {
    error_log("Error en consulta hora: " . mysqli_error($conn));
    die(json_encode(["statusCode" => 500, "error" => "Error en consulta hora"]));
}
$row_hora = mysqli_fetch_assoc($result_hora);
if (!$row_hora) {
    error_log("No se encontró hora con ID: $Fk_Hora, especialista: $Fk_Especialista y fecha: $Fk_Fecha");
    die(json_encode(["statusCode" => 404, "error" => "Hora no encontrada"]));
}
$Hora = $row_hora['Horario_Disponibilidad'];

// Consultar el IDGoogleCalendar del especialista
$sql_calendar = "SELECT IDGoogleCalendar FROM Personal_Medico_Express WHERE Medico_ID = '$Fk_Especialista'";
$result_calendar = mysqli_query($conn, $sql_calendar);
if (!$result_calendar) {
    error_log("Error en consulta GoogleCalendar: " . mysqli_error($conn));
    die(json_encode(["statusCode" => 500, "error" => "Error en consulta GoogleCalendar"]));
}
$row_calendar = mysqli_fetch_assoc($result_calendar);
if ($row_calendar && isset($row_calendar['IDGoogleCalendar'])) {
    $calendarId = $row_calendar['IDGoogleCalendar'];
} else {
    $calendarId = '';
}

// Verificar si ya existe la cita
$sql = "SELECT Fk_Especialidad, Fk_Especialista, Fk_Sucursal, Fecha, Hora, Nombre_Paciente, Telefono, Tipo_Consulta, ID_H_O_D 
        FROM AgendaCitas_EspecialistasExt 
        WHERE Fk_Especialidad='$Fk_Especialidad' AND Fk_Especialista='$Fk_Especialista' AND Fk_Sucursal='$Fk_Sucursal'
        AND Fecha='$Fk_Fecha' AND Hora='$Fk_Hora' AND Nombre_Paciente='$Nombre_Paciente' AND Telefono='$Telefono' 
        AND Tipo_Consulta='$Tipo_Consulta' AND ID_H_O_D='$ID_H_O_D'";
$resultset = mysqli_query($conn, $sql) or die("database error: " . mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);

if ($row && $row['Nombre_Paciente'] == $Nombre_Paciente && $row['Fecha'] == $Fk_Fecha && $row['Hora'] == $Fk_Hora && $row['Fk_Especialidad'] == $Fk_Especialidad) {
    echo json_encode(array("statusCode" => 250));
} else {
    // Insertar la nueva cita en la base de datos con las FK de fecha y hora
    $sql = "INSERT INTO `AgendaCitas_EspecialistasExt`(`Fk_Especialidad`, `Fk_Especialista`, `Fk_Sucursal`, `Fecha`, `Hora`, 
            `Nombre_Paciente`, `Telefono`, `Tipo_Consulta`, `Estatus_cita`, `Observaciones`, `ID_H_O_D`, `AgendadoPor`, `Sistema`, `Color_Calendario`, `IDGoogleCalendar`) 
            VALUES ('$Fk_Especialidad', '$Fk_Especialista', '$Fk_Sucursal', '$Fk_Fecha', '$Fk_Hora', '$Nombre_Paciente', '$Telefono', '$Tipo_Consulta', 
            '$Estatus_cita', '$Observaciones', '$ID_H_O_D', '$AgendadoPor', '$Sistema', '$Color_Calendario', '$calendarId')";

    if (mysqli_query($conn, $sql)) {
        // Actualizar el estado de la fecha y la hora a 'Ocupado'
        
        $sql_update_hora = "UPDATE Horarios_Citas_Ext SET Estado='Ocupado' WHERE ID_Horario='$Fk_Hora'";
        mysqli_query($conn, $sql_update_hora);
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
