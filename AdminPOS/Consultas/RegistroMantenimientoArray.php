<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

$fcha = date("Y-m-d");

// Obtiene la fecha actual en el formato 'YYYY-MM-DD'
$fechaActual = date("Y-m-d");

// Consulta SQL adaptada con la variable de fecha
$sql = "SELECT * FROM `Registros_Energia` WHERE Fecha_registro = '$fechaActual' AND Sucursal = '" . $row['Nombre_Sucursal'] . "'";

$result = mysqli_query($conn, $sql);

$data = [];

if ($result && $result->num_rows > 0) {
    $c = 0;

    while ($fila = $result->fetch_assoc()) {
        $data[$c]["Id_Registro"] = $fila["Id_Registro"];
        $data[$c]["Registro_energia"] = $fila["Registro_energia"];
        $data[$c]["Fecha_registro"] = $fila["Fecha_registro"];
        $data[$c]["Sucursal"] = $fila["Sucursal"];
        $data[$c]["Comentario"] = $fila["Comentario"];

        // Procesar imágenes si existen
        if (!empty($fila["file_name"])) {
            $imagenes = explode('|', $fila["file_name"]); // Separar las rutas de las imágenes
            $imgTags = [];
            foreach ($imagenes as $img) {
                $imgTags[] = "<img alt='avatar' class='img-thumbnail' src='https://saludapos.com/RegistroMantenimiento/$img'>";
            }
            $data[$c]["Foto"] = implode(' ', $imgTags); // Unir todas las etiquetas <img> en una cadena
        } else {
            $data[$c]["Foto"] = ""; // En caso de que no haya imágenes
        }

        $c++;
    }
}

$results = [
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
];

echo json_encode($results);
?>
