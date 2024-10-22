<?php
require '../vendor/autoload.php';
include_once 'db_connection.php';

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
            `Nombre_Paciente`, `Telefono`, `Tipo_Consulta`, `Estatus_cita`, `Observaciones`, `ID_H_O_D`, `AgendadoPor`, `Sistema`, `Color_Calendario`) 
            VALUES ('$Fk_Especialidad', '$Fk_Especialista', '$Fk_Sucursal', '$Fk_Fecha', '$Fk_Hora', '$Nombre_Paciente', '$Telefono', '$Tipo_Consulta', 
            '$Estatus_cita', '$Observaciones', '$ID_H_O_D', '$AgendadoPor', '$Sistema', '$Color_Calendario')";

    if (mysqli_query($conn, $sql)) {
        // Agregar el evento a Google Calendar
        $client = new Google_Client();
        $client->setAuthConfig('../../app-saluda-966447541c3c.json'); // Ruta al archivo JSON de credenciales
        $client->setScopes(Google_Service_Calendar::CALENDAR);
        $service = new Google_Service_Calendar($client);

        // ID del calendario
        $calendarId = '3dc95b55f97f949efe5e01222ec074eeccd45eb10888e94b4a2fc39c91a60dc4@group.calendar.google.com';

        // Ajustar el formato de la hora y fecha para el formato ISO 8601
        $startDateTime = date('Y-m-d\TH:i:s', strtotime("$Fecha $Hora")); // Formato ISO 8601
        $HoraFin = date('H:i', strtotime($Hora) + 60 * 60); // Sumar 1 hora a la hora de inicio
        $endDateTime = date('Y-m-d\TH:i:s', strtotime("$Fecha $HoraFin")); // Formato ISO 8601

        // Verificaciones antes de crear el evento
        if (!DateTime::createFromFormat('Y-m-d\TH:i:s', $startDateTime) || !DateTime::createFromFormat('Y-m-d\TH:i:s', $endDateTime)) {
            echo json_encode(array("statusCode" => 400, "error" => "Fecha y hora no válidas"));
            exit();
        }

        // Crea el evento
        $event = new Google_Service_Calendar_Event(array(
            'summary' => "Consulta de $Nombre_Paciente",
            'location' => "$Fk_Sucursal",
            'description' => "$Observaciones",
            'start' => array(
                'dateTime' => $startDateTime,
                'timeZone' => 'America/Mexico_City',
            ),
            'end' => array(
                'dateTime' => $endDateTime,
                'timeZone' => 'America/Mexico_City',
            ),
            'colorId' => '2', // Puedes comentar esta línea si no estás seguro
        ));

        // Inserta el evento en el calendario
        try {
            $event = $service->events->insert($calendarId, $event);
            echo json_encode(array("statusCode" => 200, "eventLink" => $event->htmlLink));
        } catch (Exception $e) {
            echo json_encode(array("statusCode" => 400, "error" => $e->getMessage()));
        }
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
?>
