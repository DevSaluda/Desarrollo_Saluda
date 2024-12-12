<?php
include_once 'db_connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (!empty($_POST['Problematica']) && !empty($_POST['DescripcionProblematica']) && !empty($_POST['SucursalExt']) && !empty($_POST['Agregado_Por'])) {
    $tipoProblema = mysqli_real_escape_string($conn, $_POST['Problematica']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['DescripcionProblematica']);
    $fecha = mysqli_real_escape_string($conn, $_POST['Fecha']);
    $reportadoPor = mysqli_real_escape_string($conn, $_POST['Agregado_Por']);
    $sucursal = mysqli_real_escape_string($conn, $_POST['SucursalExt']);
    $id_h_o_d = "SALUDA";
    $estatus = "Pendiente";
    $noTicket = "TS-" . strtoupper(uniqid());

    $query = "INSERT INTO Tickets_Soporte (No_Ticket, Sucursal, Reportado_Por, Fecha_Registro, Problematica, DescripcionProblematica, Estatus, Agregado_Por, ID_H_O_D) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "sssssssss", $noTicket, $sucursal, $reportadoPor, $fecha, $tipoProblema, $descripcion, $estatus, $reportadoPor, $id_h_o_d);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["statusCode" => 200]);
        } else {
            echo json_encode(["statusCode" => 201, "message" => mysqli_stmt_error($stmt)]);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(["statusCode" => 201, "message" => mysqli_error($conn)]);
    }
} else {
    echo json_encode(["statusCode" => 400, "message" => "Datos incompletos"]);
}
}
?>
