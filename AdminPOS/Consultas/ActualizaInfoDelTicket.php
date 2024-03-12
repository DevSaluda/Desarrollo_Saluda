<?php
include_once 'db_connection.php';

$contador = count($_POST["TicketPorActualizar"]);
$ProContador = 0;
$query = "UPDATE Ventas_POS_Pruebas SET
           Nombre_Prod = ?, 
           Importe = ?, 
           FormaDePago = ?, 
           Turno=?
           WHERE FolioSucursal = ? AND Folio_Ticket = ?";  

$placeholders = [];
$values = [];
$valueTypes = '';

for ($i = 0; $i < $contador; $i++) {
    if (!empty($_POST["TicketPorActualizar"][$i])) {
        $ProContador++;
        $values[] = $_POST["NombreProdActualizable"][$i];
        $values[] = $_POST["ImporteActualizable"][$i];
        $values[] = $_POST["FormaPagoActualizable"][$i];
        $values[] = $_POST["TurnoActualizable"][$i];
        $values[] = $_POST["TicketPorActualizarFolio"][$i];
        $values[] = $_POST["TicketPorActualizar"][$i];
        $valueTypes .= 'ssssss'; // Ajusta los tipos de datos según tus necesidades
    }
}

$response = array();

if ($ProContador != 0) {
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, $valueTypes, ...$values);

        $resultadocon = mysqli_stmt_execute($stmt);

        if ($resultadocon) {
            $response['status'] = 'success';
            $response['message'] = 'Registro(s) actualizado(s) correctamente.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error en la consulta de actualización: ' . mysqli_error($conn);
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error en la preparación de la consulta: ' . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    $response['status'] = 'error';
    $response['message'] = 'No se encontraron registros para actualizar.';
}

echo json_encode($response);

mysqli_close($conn);
?>
