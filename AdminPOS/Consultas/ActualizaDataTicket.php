<?php

// Incluir archivo de conexión a la base de datos
include "db_connection.php";
$response = array(
    "status" => "error",
    "message" => "No se han recibido datos mediante POST"
);
// Verificar si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Realizar las operaciones necesarias para actualizar la información del ticket

    // Obtener los datos enviados desde el formulario
    // Obtener los datos enviados desde el formulario
$codBarra = is_array($_POST["CodBarraActualizable"]) ? $_POST["CodBarraActualizable"] : [];
$nombreProd = is_array($_POST["NombreProdActualizable"]) ? $_POST["NombreProdActualizable"] : [];
$ticketPorActualizarFolio = is_array($_POST["TicketPorActualizarFolio"]) ? $_POST["TicketPorActualizarFolio"] : [];
$ticketPorActualizar = is_array($_POST["TicketPorActualizar"]) ? $_POST["TicketPorActualizar"] : [];
$importeActualizable = is_array($_POST["ImporteActualizable"]) ? $_POST["ImporteActualizable"] : [];
$formaPagoActualizable = is_array($_POST["FormaPagoActualizable"]) ? $_POST["FormaPagoActualizable"] : [];
$turnoActualizable = is_array($_POST["TurnoActualizable"]) ? $_POST["TurnoActualizable"] : [];


    // Iterar sobre los datos recibidos para actualizar cada ticket
    for ($i = 0; $i < count($codBarra); $i++) {
        // Construir la consulta SQL de actualización
        $sql = "UPDATE Ventas_POS_Pruebas SET Nombre_Prod = ?, FolioSucursal = ?, Folio_Ticket = ?, Importe = ?, FormaDePago = ?, Turno = ? WHERE FolioSucursal = ? AND Folio_Ticket = ? ";
        
        // Preparar la declaración
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param("sssissss", $nombreProd[$i], $ticketPorActualizarFolio[$i], $ticketPorActualizar[$i], $importeActualizable[$i], $formaPagoActualizable[$i], $turnoActualizable[$i], $codBarra[$i], $ticketPorActualizar[$i]);

        // Ejecutar la declaración
        $stmt->execute();

        // Verificar si la ejecución fue exitosa
        if ($stmt->affected_rows > 0) {
            // La actualización fue exitosa
            $response["status"] = "success";
            $response["message"] = "La información del ticket se ha actualizado correctamente";
        } else {
            // Ocurrió un error durante la actualización
            $response["status"] = "error";
            $response["message"] = "Ha ocurrido un error al intentar actualizar la información del ticket";
        }

        // Cerrar la declaración
        $stmt->close();
    }
} else {
    // Si no se recibieron datos mediante POST, retornar un error
    $response["status"] = "error";
    $response["message"] = "No se han recibido datos mediante POST";
}

// Cerrar la conexión a la base de datos
$conn->close();

// Retornar la respuesta en formato JSON
echo json_encode($response);

?>
