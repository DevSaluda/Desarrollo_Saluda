<?php
include("ConeSelectDinamico.php");

$sucursal = isset($_REQUEST['especialidadext']) ? intval($_REQUEST['especialidadext']) : 0;
echo "Valor de especialidadext: $sucursal";

$medicos = $conn->prepare("SELECT * FROM Personal_Medico_Express WHERE Estatus='Disponible' AND Especialidad_Express = '$sucursal'") or die(mysqli_error());

echo '<option value="">Selecciona un medico </option>';

if ($medicos->execute()) {
    $a_result = $medicos->get_result();
    while ($row = $a_result->fetch_array()) {
        echo '<option value="' . $row['Medico_ID'] . '">' . ($row['Nombre_Apellidos']) . '</option>';
    }
}
?>
