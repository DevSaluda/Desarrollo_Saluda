<?php
include("ConeSelectDinamico.php");

$sucursal = isset($_GET['sucursalExt']) ? intval($_GET['sucursalExt']) : 0;

$medicos = $conn->prepare("SELECT * FROM Personal_Medico_Express WHERE Estatus='Disponible' AND Especialidad_Express = ?");
$medicos->bind_param("i", $sucursal);

if ($medicos->execute()) {
    $a_result = $medicos->get_result();
    echo '<option value="">Selecciona un medico </option>';
    while ($row = $a_result->fetch_array()) {
        echo '<option value="' . $row['Medico_ID'] . '">' . $row['Nombre_Apellidos'] . '</option>';
    }
} else {
    echo "Error al ejecutar la consulta: " . $conn->error;
}

$medicos->close();
$conn->close();
?>
