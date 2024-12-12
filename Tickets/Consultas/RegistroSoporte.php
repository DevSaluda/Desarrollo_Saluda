<?php
include_once 'db_connection.php';

if (!empty($_POST['Problematica']) && !empty($_POST['DescripcionProblematica'])) {
    // Validación y sanitización de datos
    $tipoProblema = mysqli_real_escape_string($conn, $_POST['Problematica']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['DescripcionProblematica']);
    $fecha = mysqli_real_escape_string($conn, $_POST['Fecha']);
    $reportadoPor = mysqli_real_escape_string($conn, $_POST['Agregado_Por']);
    $sucursal = mysqli_real_escape_string($conn, $_POST['Sucursal']);
    $id_h_o_d = mysqli_real_escape_string($conn, $_POST['ID_H_O_D']);
    
    // Definir estatus inicial
    $estatus = "Pendiente";

    // Generar un número de ticket único
    $noTicket = "TS-" . strtoupper(uniqid());

    // Preparar la consulta
    $query = "INSERT INTO Tickets_Soporte 
        (No_Ticket, Sucursal, Reportado_Por, Fecha_Registro, Problematica, DescripcionProblematica, Estatus, Agregado_Por, ID_H_O_D) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, SALUDA)";

    // Preparar la declaración
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "sssssssss", $noTicket, $sucursal, $reportadoPor, $fecha, $tipoProblema, $descripcion, $estatus, $reportadoPor, $id_h_o_d);

        if (mysqli_stmt_execute($stmt)) {
            // Respuesta de éxito
            $response = array("statusCode" => 200);
        } else {
            // Respuesta de error al ejecutar la consulta
            $response = array("statusCode" => 201, "message" => "Error: " . mysqli_stmt_error($stmt));
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        // Respuesta de error al preparar la consulta
        $response = array("statusCode" => 201, "message" => "Error: " . mysqli_error($conn));
    }
} else {
    // Respuesta en caso de campos faltantes
    $response = array("statusCode" => 400, "message" => "Todos los campos son obligatorios.");
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Enviar la respuesta en formato JSON
echo json_encode($response);

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
