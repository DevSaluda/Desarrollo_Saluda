<?php
include("ConeSelectDinamico.php");

// Imprimir contenido de $_REQUEST para fines de depuración
var_dump($_REQUEST);

// Obtener el valor de 'especialidadext' y escapar para evitar inyección SQL
$sucursal = isset($_REQUEST['especialidadext']) ? mysqli_real_escape_string($conn, $_REQUEST['especialidadext']) : '';

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
