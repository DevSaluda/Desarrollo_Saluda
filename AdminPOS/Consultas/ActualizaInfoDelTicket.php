<?php

// Verificar si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir archivo de conexión a la base de datos y otras funciones necesarias
    include "db_connection.php";

    // Verificar si las variables son arreglos antes de iterar sobre ellas
    if (is_array($_POST["CodBarraActualizable"]) && is_array($_POST["NombreProdActualizable"]) && is_array($_POST["TicketPorActualizarFolio"]) && is_array($_POST["TicketPorActualizar"]) && is_array($_POST["ImporteActualizable"]) && is_array($_POST["FormaPagoActualizable"]) && is_array($_POST["TurnoActualizable"])) {
        // Asignar los datos a variables locales
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
            $sql = "UPDATE Ventas_POS_Pruebas SET Nombre_Prod = ?, FolioSucursal = ?, Folio_Ticket = ?, Importe = ?, FormaDePago = ?, Turno = ? WHERE FolioSucursal = ? AND Folio_Ticket = ? ";
            
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
    } else {
        // Si alguna de las variables no es un arreglo, retornar un error
        $response["status"] = "error";
        $response["message"] = "Los datos recibidos no son válidos";
        echo json_encode($response);
        exit; // Salir del script para evitar más ejecución
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
