<?php
include("ConeSelectDinamico.php");

// Obtén el valor del parámetro especialidadext
$sucursal = intval($_REQUEST['especialidadext']);

// Prepara la consulta con un marcador de posición
$medicos = $conn->prepare("SELECT * FROM Personal_Medico_Express WHERE Estatus='Disponible' AND Especialidad_Express = ?") or die(mysqli_error());

// Vincula el parámetro
$medicos->bind_param("i", $sucursal);

echo '<option value = "">Selecciona un medico </option>';

// Ejecuta la consulta
if ($medicos->execute()) {
    $a_result = $medicos->get_result();

    while ($row = $a_result->fetch_array()) {
        echo '<option value="' . $row['Medico_ID'] . '">' . $row['Nombre_Apellidos'] . '</option>';
    }
}

// Cierra la conexión y la consulta
$medicos->close();
$conn->close();
?>
