<?php
include_once 'db_connection.php';

if (!empty($_POST['name']) || !empty($_FILES['file']['name'])) {
    $uploadedFiles = [];
    $ticketId = null;

    // Inserta el registro principal en la tabla `TicketsSoporte`
    $tipoProblema = $_POST['tipoProblema'];
    $descripcion = $_POST['DescripcionProblematica'];
    $fecha = $_POST['Fecha'];
    $registro = $_POST['Registro'];
    $sucursal = $_POST['Sucursal'];
    $empresa = $_POST['Empresa'];

    $queryTicket = "INSERT INTO TicketsSoporte 
    (Tipo_Problema, Descripcion, Fecha_Registro, Sucursal, Registro, AgregadoEl, ID_H_O_D) 
    VALUES ('$tipoProblema', '$descripcion', '$fecha', '$sucursal', '$registro', NOW(), '$empresa')";

    if (mysqli_query($conn, $queryTicket)) {
        // Obtén el ID del ticket recién creado
        $ticketId = mysqli_insert_id($conn);
    } else {
        $response = array("statusCode" => 201, "message" => "Error al registrar el ticket principal");
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
