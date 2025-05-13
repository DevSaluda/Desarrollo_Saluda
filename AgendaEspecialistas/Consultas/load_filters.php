<?php
include 'db_connection.php'; // Cambia a la ruta correcta de conexión a tu base de datos

// Cargar Especialistas
$especialistasResult = $conn->query("SELECT Medico_ID, Nombre_Apellidos FROM Personal_Medico_Express");
$especialistasOptions = "";
while ($row = $especialistasResult->fetch_assoc()) {
    $especialistasOptions .= "<option value='" . $row['Medico_ID'] . "'>" . $row['Nombre_Apellidos'] . "</option>";
}

// Cargar Sucursales
$sucursalesResult = $conn->query("SELECT ID_SucursalC, Nombre_Sucursal FROM SucursalesCorre");
$sucursalesOptions = "";
while ($row = $sucursalesResult->fetch_assoc()) {
    $sucursalesOptions .= "<option value='" . $row['ID_SucursalC'] . "'>" . $row['Nombre_Sucursal'] . "</option>";
}

// Devolver opciones como JSON
echo json_encode([
    'especialistas' => $especialistasOptions,
    'sucursales' => $sucursalesOptions
]);
?>
