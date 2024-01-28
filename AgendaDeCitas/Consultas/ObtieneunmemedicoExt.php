<?php
include("ConeSelectDinamico.php");

// Verifica si 'especialidadext' está presente en $_REQUEST
$sucursal = isset($_REQUEST['especialidadext']) ? intval($_REQUEST['especialidadext']) : 0;

// Verifica si se proporcionó un valor válido para 'especialidadext'
if ($sucursal > 0) {
    // Prepara la consulta con un marcador de posición
    $medicos = $conn->prepare("SELECT * FROM Personal_Medico_Express WHERE Estatus='Disponible' AND Especialidad_Express = ?") or die(mysqli_error($conn));

    // Vincula el parámetro
    $medicos->bind_param("i", $sucursal);

    echo '<option value = "">Selecciona un medico </option>';

    // Ejecuta la consulta
    if ($medicos->execute()) {
        $a_result = $medicos->get_result();

        while ($row = $a_result->fetch_array()) {
            echo '<option value="' . $row['Medico_ID'] . '">' . $row['Nombre_Apellidos'] . '</option>';
        }
    } else {
        // Manejo de error si la consulta no se ejecuta correctamente
        die(mysqli_error($conn));
    }

    // Cierra la conexión y la consulta
    $medicos->close();
} else {
    // Manejo de error si 'especialidadext' no está presente o no es válido
    die("Error: La especialidad no es válida.");
}

$conn->close();
?>
