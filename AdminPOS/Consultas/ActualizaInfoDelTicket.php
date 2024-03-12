<?php
include_once 'db_connection.php';

// Verifica si se recibieron los datos esperados del formulario
if (!isset($_POST["TicketPorActualizar"], $_POST["NombreProdActualizable"], $_POST["ImporteActualizable"], $_POST["FormaPagoActualizable"], $_POST["TurnoActualizable"], $_POST["TicketPorActualizarFolio"])) {
    $response['status'] = 'error';
    $response['message'] = 'No se recibieron todos los datos necesarios del formulario.';
    echo json_encode($response);
    exit(); // Sale del script si no se recibieron todos los datos
}

// Obtiene el número de elementos en el array
$contador = count($_POST["TicketPorActualizar"]);

// Inicializa el contador de registros actualizados
$ProContador = 0;

// Consulta SQL para actualizar los registros
$query = "UPDATE Ventas_POS_Pruebas SET
           Nombre_Prod = ?, 
           Importe = ?, 
           FormaDePago = ?, 
           Turno = ?
           WHERE FolioSucursal = ? AND Folio_Ticket = ?";  

// Inicializa arrays para almacenar los valores y tipos de datos
$values = [];
$valueTypes = '';

// Recorre los datos recibidos del formulario
for ($i = 0; $i < $contador; $i++) {
    if (!empty($_POST["TicketPorActualizar"][$i])) {
        $ProContador++;

        // Agrega los valores a los arrays
        $values[] = $_POST["NombreProdActualizable"][$i];
        $values[] = $_POST["ImporteActualizable"][$i];
        $values[] = $_POST["FormaPagoActualizable"][$i];
        $values[] = $_POST["TurnoActualizable"][$i];
        $values[] = $_POST["TicketPorActualizarFolio"][$i];
        $values[] = $_POST["TicketPorActualizar"][$i];

        // Agrega los tipos de datos a la cadena
        $valueTypes .= 'ssssss'; // Ajusta los tipos de datos según tus necesidades
    }
}

// Verifica si hay registros para actualizar
if ($ProContador == 0) {
    $response['status'] = 'error';
    $response['message'] = 'No se encontraron registros para actualizar.';
    echo json_encode($response);
    exit(); // Sale del script si no hay registros para actualizar
}

// Prepara la respuesta por defecto
$response = array(
    'status' => 'error',
    'message' => 'Ocurrió un error durante la actualización.'
);

// Prepara y ejecuta la consulta SQL preparada
$stmt = mysqli_prepare($conn, $query);
if ($stmt) {
    // Vincula los parámetros a la consulta
    mysqli_stmt_bind_param($stmt, $valueTypes, ...$values);

    // Ejecuta la consulta
    $resultadocon = mysqli_stmt_execute($stmt);

    if ($resultadocon) {
        $response['status'] = 'success';
        $response['message'] = 'Registro(s) actualizado(s) correctamente.';
    } else {
        $response['message'] = 'Error en la consulta de actualización: ' . mysqli_error($conn);
    }
} else {
    $response['message'] = 'Error en la preparación de la consulta: ' . mysqli_error($conn);
}

// Retorna la respuesta como JSON
echo json_encode($response);

// Cierra la conexión a la base de datos
mysqli_close($conn);
?>
