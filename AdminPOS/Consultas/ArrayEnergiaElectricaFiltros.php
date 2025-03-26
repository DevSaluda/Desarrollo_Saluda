<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Verifica si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si las variables están seteadas y no son nulas
    if (isset($_POST['Mes']) && isset($_POST['anual'])) {
        // Obtén los valores del formulario
        $mes = $conn->real_escape_string($_POST['Mes']);
        $anual = $conn->real_escape_string($_POST['anual']);

    

        // Consulta SQL para filtrar registros por rango de fechas
        $sql = "SELECT 
                    Id_Registro,
                    Registro_energia,
                    Fecha_registro,
                    Sucursal,
                    Comentario,
                    Registro AS Registrado,
                    Agregadoel AS Horaregistro
                FROM 
                    Registros_Energia
                WHERE 
                    Fecha_registro BETWEEN '$mes' AND '$anual'";

        $result = mysqli_query($conn, $sql);

        $data = [];
        $c = 0;

        // Procesa los resultados de la consulta
        while ($fila = $result->fetch_assoc()) {
            $data[$c]["Id_Registro"] = $fila["Id_Registro"];
            $data[$c]["Registro_energia"] = $fila["Registro_energia"];
            $data[$c]["Fecha_registro"] = $fila["Fecha_registro"];
            $data[$c]["Sucursal"] = $fila["Sucursal"];
            $data[$c]["Comentario"] = $fila["Comentario"];
            $data[$c]["Registrado"] = $fila["Registrado"];
            $data[$c]["Horaregistro"] = $fila["Horaregistro"];
            $c++;
        }

        // Construye la respuesta en formato JSON
        $results = [
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        ];

        echo json_encode($results);
    } else {
        // Si alguna de las variables no está seteada o es nula, muestra un mensaje de error
        echo json_encode([
            "sEcho" => 1,
            "iTotalRecords" => 0,
            "iTotalDisplayRecords" => 0,
            "aaData" => [],
            "error" => "No se recibieron todas las variables necesarias."
        ]);
    }
} else {
    // Si no se recibe una solicitud POST, muestra un mensaje de error
    echo json_encode([
        "sEcho" => 1,
        "iTotalRecords" => 0,
        "iTotalDisplayRecords" => 0,
        "aaData" => [],
        "error" => "Método de solicitud no válido."
    ]);
}
?>