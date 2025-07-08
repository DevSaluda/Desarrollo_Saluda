<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'db_connection.php';

// Verificar que la conexión a la base de datos esté establecida
if (!$conn) {
    die(json_encode(array("statusCode" => 500, "message" => "Error en la conexión con la base de datos")));
}

if (!empty($_POST['Problematica']) && !empty($_POST['DescripcionProblematica']) && !empty($_POST['Fecha']) && !empty($_POST['Agregado_Por']) && !empty($_POST['SucursalExt'])) {
    // Validación y sanitización de datos
    $tipoProblema = mysqli_real_escape_string($conn, $_POST['Problematica']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['DescripcionProblematica']);
    $fecha = mysqli_real_escape_string($conn, $_POST['Fecha']);
    $reportadoPor = mysqli_real_escape_string($conn, $_POST['Agregado_Por']);
    $sucursal = mysqli_real_escape_string($conn, $_POST['SucursalExt']);
    
    // Validación de la fecha
    if (!strtotime($fecha)) {
        $response = array("statusCode" => 400, "message" => "La fecha proporcionada no es válida.");
        echo json_encode($response);
        exit;
    }

    // Definir estatus inicial
    $estatus = "Pendiente";

    // Consultar el último número de ticket
    $result = mysqli_query($conn, "SELECT MAX(Id_Ticket) as last_id FROM Tickets_Soporte");
    $row = mysqli_fetch_assoc($result);
    $lastId = isset($row['last_id']) ? intval($row['last_id']) : 0;

    // Incrementar el identificador
    $nextId = $lastId + 1;

    // Generar el número de ticket
    $noTicket = "TS-" . str_pad($nextId, 4, "0", STR_PAD_LEFT); // Ejemplo: TS-0001

    // Preparar la consulta
    $query = "INSERT INTO Tickets_Soporte 
    (No_Ticket, Sucursal, Reportado_Por, Fecha_Registro, Problematica, DescripcionProblematica, Estatus, Agregado_Por) 
    VALUES 
    (?, ?, ?, ?, ?, ?, ?, ?)"; // 8 placeholders

    // Preparar la declaración
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "ssssssss", $noTicket, $sucursal, $reportadoPor, $fecha, $tipoProblema, $descripcion, $estatus, $reportadoPor);

        if (mysqli_stmt_execute($stmt)) {
            // Respuesta de éxito
            $response = array(
                "statusCode" => 200,
                'ticketNumber' => $noTicket
            );
        } else {
            // Respuesta de error al ejecutar la consulta
            $response = array("statusCode" => 201, "message" => "Error al guardar el ticket: " . mysqli_stmt_error($stmt));
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        // Respuesta de error al preparar la consulta
        $response = array("statusCode" => 201, "message" => "Error al preparar la consulta: " . mysqli_error($conn));
    }
} else {
    // Respuesta en caso de campos faltantes
    $response = array("statusCode" => 400, "message" => "Todos los campos son obligatorios.");
}

// Enviar la respuesta en formato JSON
echo json_encode($response);

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
