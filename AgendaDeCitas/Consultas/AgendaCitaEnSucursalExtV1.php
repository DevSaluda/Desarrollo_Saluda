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
$Fecha = $conn->real_escape_string(trim($_POST['FechaExt']));
$Hora = $conn->real_escape_string(trim($_POST['HorasExt']));
$Nombre_Paciente = $conn->real_escape_string(trim($_POST['NombresExt']));
$Telefono = $conn->real_escape_string(trim($_POST['TelExt']));
$Tipo_Consulta = $conn->real_escape_string(trim($_POST['TipoConsultaExt']));
$Estatus_cita = $conn->real_escape_string(trim($Cita));
$Observaciones = $conn->real_escape_string(trim($_POST['ObservacionesExt']));
$ID_H_O_D = $conn->real_escape_string(trim($_POST['EmpresaExt']));
$AgendadoPor = $conn->real_escape_string(trim($_POST['UsuarioExt']));
$Sistema = $conn->real_escape_string(trim($_POST['SistemaExt']));
$Color_Calendario = $conn->real_escape_string(trim($ColorClaveCalendario));

// Verificar si ya existe la cita
$sql = "SELECT Fk_Especialidad, Fk_Especialista, Fk_Sucursal, Fecha, Hora, Nombre_Paciente, Telefono, Tipo_Consulta, ID_H_O_D 
        FROM AgendaCitas_EspecialistasExt 
        WHERE Fk_Especialidad='$Fk_Especialidad' AND Fk_Especialista='$Fk_Especialista' AND Fk_Sucursal='$Fk_Sucursal'
        AND Fecha='$Fecha' AND Hora='$Hora' AND Nombre_Paciente='$Nombre_Paciente' AND Telefono='$Telefono' 
        AND Tipo_Consulta='$Tipo_Consulta' AND ID_H_O_D='$ID_H_O_D'";
$resultset = mysqli_query($conn, $sql) or die("database error: " . mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);

if ($row && $row['Nombre_Paciente'] == $Nombre_Paciente && $row['Fecha'] == $Fecha && $row['Hora'] == $Hora && $row['Fk_Especialidad'] == $Fk_Especialidad) {
    echo json_encode(array("statusCode" => 250));
} else {
    // Insertar la nueva cita en la base de datos
    $sql = "INSERT INTO `AgendaCitas_EspecialistasExt`(`Fk_Especialidad`, `Fk_Especialista`, `Fk_Sucursal`, `Fecha`, `Hora`, 
            `Nombre_Paciente`, `Telefono`, `Tipo_Consulta`, `Estatus_cita`, `Observaciones`, `ID_H_O_D`, `AgendadoPor`, `Sistema`, `Color_Calendario`) 
            VALUES ('$Fk_Especialidad', '$Fk_Especialista', '$Fk_Sucursal', '$Fecha', '$Hora', '$Nombre_Paciente', '$Telefono', '$Tipo_Consulta', 
            '$Estatus_cita', '$Observaciones', '$ID_H_O_D', '$AgendadoPor', '$Sistema', '$Color_Calendario')";

    if (mysqli_query($conn, $sql)) {
        // Agregar el evento a Google Calendar
        $client = new Google_Client();
        $client->setAuthConfig('../../app-saluda-966447541c3c.json'); // Ruta al archivo JSON de credenciales
        $client->setScopes(Google_Service_Calendar::CALENDAR);
        $service = new Google_Service_Calendar($client);

        // ID del calendario
        $calendarId = 'primary'; // Cambia esto si usas un calendario específico

        // Calcula la hora de finalización de la cita, por ejemplo, una duración de 1 hora
        $startDateTime = "$Fecha" . "T" . "$Hora:00"; // Formato ISO 8601
        $HoraFin = date('H:i', strtotime($Hora) + 60 * 60); // Suma 1 hora a la hora de inicio
        $endDateTime = "$Fecha" . "T" . "$HoraFin:00"; // Formato ISO 8601

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
            'attendees' => array(
                array('email' => 'jesusemutul@gmail.com'), // Cambia esto por el correo del especialista
            ),
            'colorId' => '2', // Color para el evento en el calendario
        ));

        // Inserta el evento en el calendario
        $event = $service->events->insert($calendarId, $event);

        echo json_encode(array("statusCode" => 200, "eventLink" => $event->htmlLink));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
?>
