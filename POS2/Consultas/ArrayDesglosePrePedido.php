<?php
header('Content-Type: application/json');

$fechaActual = date('Y-m-d'); // Esto obtiene la fecha actual en el formato 'Año-Mes-Día'
include("db_connection.php");
include "Consultas.php";

// Verifica si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Usar var_dump para ver lo que está siendo recibido
    var_dump($_POST); // Muestra todos los datos que se están enviando por POST
    exit; // Detiene la ejecución para que puedas ver el resultado

    // Verifica si las variables están seteadas y no son nulas
    if (isset($_POST['Mes']) && isset($_POST['fechainicio']) && isset($_POST['fechafin'])) {
        // Obtén los valores del formulario
        $mes = $_POST['Mes'];
        $fechainicio = $_POST['fechainicio'];
        $fechafin = $_POST['fechafin'];
       
        // Aquí sigue tu consulta SQL y el procesamiento...
    } else {
        // Si alguna de las variables no está seteada o es nula, muestra un mensaje de error
        echo json_encode(["error" => "No se recibieron todas las variables necesarias."]);
    }
}
?>