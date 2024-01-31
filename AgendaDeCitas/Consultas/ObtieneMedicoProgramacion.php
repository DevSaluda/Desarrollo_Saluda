<?php
include("ConeSelectDinamico.php");

// Verificar si "especialidadext" está definido en $_REQUEST
$sucursal = isset($_REQUEST['especialidadext']) ? intval($_REQUEST['especialidadext']) : 0;

// Preparar la consulta utilizando un statement
$medicos = $conn->prepare("SELECT * FROM Personal_Medico_Express WHERE Estatus='Disponible' AND Especialidad_Express = ?") or die(mysqli_error());

// Asignar el valor de "especialidadext" al statement
$medicos->bind_param("i", $sucursal);

// Ejecutar la consulta
if ($medicos->execute()) {
    // Obtener el resultado
    $a_result = $medicos->get_result();

    // Imprimir la opción predeterminada
    echo '<option value="">Selecciona un medico </option>';

    // Imprimir opciones basadas en el resultado de la consulta
    while ($row = $a_result->fetch_array()) {
        echo '<option value="' . $row['Medico_ID'] . '">' . ($row['Nombre_Apellidos']) . '</option>';
    }
} else {
    // Manejar cualquier error en la ejecución de la consulta
    echo "Error al ejecutar la consulta";
}

// Cerrar la conexión y liberar recursos
$medicos->close();
$conn->close();
?>
