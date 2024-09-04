<?php
$servername = "localhost";
$username = "somosgr1_SHWEB";
$password = "yH.0a-v?T*1R";
$dbname = "somosgr1_Sistema_Hospitalario";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el término de búsqueda enviado por AJAX
$searchTerm = $_GET['term'];

// Definir el límite de búsqueda
$limit = 10; // Cambia el valor segun la necesidad que requieran.

// Consultar la base de datos para obtener los nombres de los clientes que coincidan con el término de búsqueda aplicando el limite a 10
$sql = "SELECT Nombre_Paciente FROM Data_Pacientes WHERE Nombre_Paciente LIKE CONCAT('%', ?, '%') LIMIT ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $searchTerm, $limit);
$stmt->execute();
$result = $stmt->get_result();

$clientes = array();

if ($result->num_rows > 0) {
    // Si se encontraron clientes, almacenar sus nombres en un array
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row['Nombre_Paciente'];
    }
}

// Devolver los nombres de los clientes como una lista JSON
header('Content-Type: application/json');
echo json_encode($clientes);

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();
?>
