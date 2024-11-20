<?php
include_once 'db_connection.php';

if (!empty($_POST['tipoProblema']) && !empty($_POST['DescripcionProblematica'])) {
    $tipoProblema = $_POST['tipoProblema'];
    $descripcion = $_POST['DescripcionProblematica'];
    $fecha = $_POST['Fecha'];
    $reportadoPor = $_POST['Agregado_Por'];
    $sucursal = $_POST['Sucursal'];
    $estatus = "Pendiente"; // Asignar el estatus inicial
    $id_h_o_d = $_POST['ID_H_O_D'];

    // Generar un número de ticket único (puedes personalizarlo)
    $noTicket = "TS-" . strtoupper(uniqid());

    $query = "INSERT INTO Tickets_Soporte 
        (No_Ticket, Sucursal, Reportado_Por, Fecha_Registro, Problematica, DescripcionProblematica, Estatus, Agregado_Por, ID_H_O_D) 
        VALUES 
        ('$noTicket', '$sucursal', '$reportadoPor', '$fecha', '$tipoProblema', '$descripcion', '$estatus', '$reportadoPor', '$id_h_o_d')";

    if (mysqli_query($conn, $query)) {
        $response = array("statusCode" => 200);
    } else {
        $response = array("statusCode" => 201, "message" => "Error: " . mysqli_error($conn));
    }

    echo json_encode($response);
}
?>
