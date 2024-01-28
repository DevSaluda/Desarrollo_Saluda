<?php
include("ConeSelectDinamico.php");

// Verificar si 'especialidadext' está definido en $_REQUEST
if (isset($_REQUEST['especialidadext'])) {
    $sucursal = intval($_REQUEST['especialidadext']);
    
    // Utilizar sentencia preparada para evitar SQL injection
    $medicos = $conn->prepare("SELECT * FROM Personal_Medico_Express WHERE Estatus='Disponible' AND Especialidad_Express = ?") or die(mysqli_error());
    $medicos->bind_param("i", $sucursal);

    echo '<option value = "">Selecciona un medico </option>';

    if ($medicos->execute()) {
        $a_result = $medicos->get_result();

        while ($row = $a_result->fetch_array()) {
            echo '<option value = "' . $row['Medico_ID'] . '">' . $row['Nombre_Apellidos'] . '</option>';
        }
    } else {
        echo "Error en la ejecución de la consulta.";
    }

    // Cerrar la conexión, si es necesario
    $medicos->close();
    $conn->close();
} else {
    echo "Parámetro 'especialidadext' no definido en la solicitud.";
}
?>
