<?php
    include("ConeSelectDinamico.php");
    $especialidad = $_REQUEST['especialidadExt'];

    if ($conn) {
        $tiposConsulta = $conn->prepare("SELECT Tipo_ID, Nom_Tipo FROM Tipos_Consultas WHERE Estado='Vigente' AND Especialidad = ?");
        if ($tiposConsulta) {
            $tiposConsulta->bind_param("s", $especialidad);
            if ($tiposConsulta->execute()) {
                $result = $tiposConsulta->get_result();
                while ($row = $result->fetch_array()) {
                    echo '<option value="' . $row['Tipo_ID'] . '">' . $row['Nom_Tipo'] . '</option>';
                }
            } else {
                echo '<option value="">Error en la ejecución de la consulta</option>';
            }
            $tiposConsulta->close();
        } else {
            echo '<option value="">Error en la preparación de la consulta</option>';
        }
        $conn->close();
    } else {
        echo '<option value="">Error en la conexión a la base de datos</option>';
    }
?>
