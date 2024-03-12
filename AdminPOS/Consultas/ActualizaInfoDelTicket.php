<?php

// Verificar si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir archivo de conexión a la base de datos y otras funciones necesarias
    include "../Consultas/db_connection.php";

    // Realizar las operaciones necesarias para actualizar la información del ticket

    // Por ejemplo, podrías obtener los datos enviados desde el formulario
    $codBarra = $_POST["CodBarraActualizable"];
    $nombreProd = $_POST["NombreProdActualizable"];
    $ticketPorActualizarFolio = $_POST["TicketPorActualizarFolio"];
    $ticketPorActualizar = $_POST["TicketPorActualizar"];
    $importeActualizable = $_POST["ImporteActualizable"];
    $formaPagoActualizable = $_POST["FormaPagoActualizable"];
    $turnoActualizable = $_POST["TurnoActualizable"];

    // Iterar sobre los datos recibidos para actualizar cada ticket
    for ($i = 0; $i < count($codBarra); $i++) {
        // Construir la consulta SQL de actualización
        $sql = "UPDATE Ventas_POS SET Nombre_Prod = ?, FolioSucursal = ?, Folio_Ticket = ?, Importe = ?, FormaDePago = ?, Turno = ? WHERE FolioSucursal = ? AND Folio_Ticket = ? ";
        
        // Preparar la declaración
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param("sssiss", $nombreProd[$i], $ticketPorActualizarFolio[$i], $ticketPorActualizar[$i], $importeActualizable[$i], $formaPagoActualizable[$i], $turnoActualizable[$i], $codBarra[$i]);

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

    // Cerrar la conexión a la base de datos
    $conn->close();

    // Retornar la respuesta en formato JSON
    echo json_encode($response);
} else {
    // Si no se recibieron datos mediante POST, retornar un error
    $response["status"] = "error";
    $response["message"] = "No se han recibido datos mediante POST";
    echo json_encode($response);
}

?>
