
<?php
include("ConeSelectDinamico.php");

$sucursal = isset($_REQUEST['especialidadext']) ? mysqli_real_escape_string($conn, $_REQUEST['especialidadext']) : '';

$medicos = $conn->prepare("SELECT * FROM Personal_Medico_Express WHERE Estatus='Disponible' AND Especialidad_Express = '$sucursal'") or die(mysqli_error());

// No incluir etiquetas HTML aquí

if ($medicos->execute()) {
    $a_result = $medicos->get_result();
    while ($row = $a_result->fetch_array()) {
        echo '<option value="' . $row['Medico_ID'] . '">' . ($row['Nombre_Apellidos']) . '</option>';
    }
}
?>
