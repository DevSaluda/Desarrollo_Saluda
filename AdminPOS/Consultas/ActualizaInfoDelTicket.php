<?php
// Incluir archivo de conexión a la base de datos
include("db_connection.php");

// Iterar sobre los datos recibidos y actualizar la base de datos
for ($i = 0; $i < count($_POST['CodBarraActualizable']); $i++) {
    $IDVENTAS = $_POST["IDVENTAS"][$i];
    $codBarra = $_POST["CodBarraActualizable"][$i];
    $nombreProd = $_POST["NombreProdActualizable"][$i];
    $ticketPorActualizarFolio = $_POST["TicketPorActualizarFolio"][$i];
    $ticketPorActualizar = $_POST["TicketPorActualizar"][$i];
    $importeActualizable = $_POST["ImporteActualizable"][$i];
    $formaPagoActualizable = $_POST["FormaPagoActualizable"][$i];
    $turnoActualizable = $_POST["TurnoActualizable"][$i];
 
    // Realizar la actualización en la base de datos
    $sql_update = $conn->query("UPDATE Ventas_POS_Pruebas SET Nombre_Prod = '$nombreProd', 
    FolioSucursal = '$ticketPorActualizarFolio', Folio_Ticket = '$ticketPorActualizar', 
    Importe = '$importeActualizable', FormaDePago = '$formaPagoActualizable', Turno = '$turnoActualizable'
     WHERE IDVENTAS = '$IDVENTAS' ");
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
