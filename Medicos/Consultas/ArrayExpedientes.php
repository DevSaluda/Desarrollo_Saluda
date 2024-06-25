<?php
header('Content-Type: application/json');
include("db_connection.php"); // Incluye el archivo de conexión a la base de datos
// Incluye los archivos necesarios
include "Consultas.php";
include "Sesion.php";

// Consulta SQL para obtener los datos de expedientes
$sql = "SELECT Id_expediente, Antecedentes_personales, Antecedentes_familiares, Medicamentos_actuales, Diagnosticos, Estudios_realizados, Tratamientos, Notas, Notas_adicionales
        FROM Expediente_Medico ORDER BY Id_expediente DESC";

$result = mysqli_query($conn, $sql);

$data = array(); // Inicializa un array vacío para almacenar los datos

while ($fila = $result->fetch_assoc()) {
    // Almacena cada fila de expediente en el array $data
    $data[] = array(
        "ID_Expediente" => $fila["Id_expediente"],
        "Antecedentes_Personales" => $fila["Antecedentes_personales"],
        "Antecedentes_Familiares" => $fila["Antecedentes_familiares"],
        "Medicamentos_Actuales" => $fila["Medicamentos_actuales"],
        "Diagnosticos" => $fila["Diagnosticos"],
        "Estudios_Realizados" => $fila["Estudios_realizados"],
        "Tratamientos" => $fila["Tratamientos"],
        "Notas" => $fila["Notas"],
        "Notas_Adicionales" => $fila["Notas_adicionales"]
    );
}

// Prepara la estructura de datos requerida por DataTables
$results = array(
    "sEcho" => 1, // Número de iteración de la petición
    "iTotalRecords" => count($data), // Total de registros en la tabla (sin filtrar)
    "iTotalDisplayRecords" => count($data), // Total de registros que se muestran después de aplicar filtros
    "aaData" => $data // Datos de los expedientes
);

// Devuelve los resultados como JSON
echo json_encode($results);
?>
