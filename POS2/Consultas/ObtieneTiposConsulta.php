<?php
    include("ConeSelectDinamico.php");
    $especialidad = intval($_REQUEST['especialidadExt']);
    
    $tiposConsulta = $conn->prepare("SELECT Tipo_ID, Nom_Tipo FROM Tipos_Consultas WHERE Estado='Vigente' AND Especialidad = ?") or die(mysqli_error($conn));
    $tiposConsulta->bind_param("i", $especialidad);
    
    echo '<option value="">Elige un tipo de consulta</option>';
    
    if ($tiposConsulta->execute()) {
        $result = $tiposConsulta->get_result();
        while ($row = $result->fetch_array()) {
            echo '<option value="' . $row['Tipo_ID'] . '">' . $row['Nom_Tipo'] . '</option>';
        }
    }
    
    $tiposConsulta->close();
    $conn->close();
?>
