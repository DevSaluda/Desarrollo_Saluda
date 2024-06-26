<?php
include "Consultas/Consultas.php";
include "Header.php";
include "dbconect.php";

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_expediente'])) {
    $idExpediente = $_POST['id_expediente'];
    $antecedentesPersonales = $_POST['antecedentes_personales'];
    $antecedentesFamiliares = $_POST['antecedentes_familiares'];
    $medicamentosActuales = $_POST['medicamentos_actuales'];
    $diagnosticos = $_POST['diagnosticos'];
    $estudiosRealizados = $_POST['estudios_realizados'];
    $tratamientos = $_POST['tratamientos'];
    $notas = $_POST['notas'];
    $notasAdicionales = $_POST['notas_adicionales'];

    // Consulta preparada para actualizar el expediente
    $query = "UPDATE Expediente_Medico SET 
              Antecedentes_personales = ?, 
              Antecedentes_familiares = ?, 
              Medicamentos_actuales = ?, 
              Diagnosticos = ?, 
              Estudios_realizados = ?, 
              Tratamientos = ?, 
              Notas = ?, 
              Notas_adicionales = ?, 
              Fecha_ultima_modificacion = NOW() 
              WHERE Id_expediente = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssssssssi", 
            $antecedentesPersonales,
            $antecedentesFamiliares,
            $medicamentosActuales,
            $diagnosticos,
            $estudiosRealizados,
            $tratamientos,
            $notas,
            $notasAdicionales,
            $idExpediente
        );

        if ($stmt->execute()) {
            echo "<script>alert('Expediente actualizado exitosamente.'); window.location.href = 'ExpedienteCompleto.php?id=$idExpediente';</script>";
        } else {
            echo "<script>alert('Error al actualizar el expediente.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error en la preparación de la consulta SQL: " . $conn->error . "');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Expediente Completo | <?php echo $row['ID_H_O_D']?> <?php echo $row['Nombre_Sucursal']?> </title>
  <style>
    .error {
      color: red;
      margin-left: 5px;
    }
    .table-details {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }
    .table-details th, .table-details td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    .table-details th {
      background-color: #0057b8;
      color: white;
    }
  </style>
</head>
<body>

<?php include_once ("Menu.php")?>

<div class="container">
  <div class="card">
    <div class="card-header" style="background-color: #0057b8; color: white;">
      Expediente Completo del Paciente
    </div>
    <div class="card-body">
      <?php
      if (isset($_GET['id'])) {
        $idExpediente = $_GET['id'];
        
        // Obtener información del expediente (consulta preparada)
        $queryExpediente = "SELECT * FROM Expediente_Medico WHERE Id_expediente = ?";
        
        if ($stmt = $conn->prepare($queryExpediente)) {
            $stmt->bind_param("i", $idExpediente);
            $stmt->execute();
            $resultExpediente = $stmt->get_result();
            
            if ($resultExpediente->num_rows > 0) {
                $expediente = $resultExpediente->fetch_assoc();
                $idPaciente = $expediente['Id_paciente'];
                
                // Obtener información del paciente
                $queryPaciente = "SELECT * FROM Data_Pacientes WHERE ID_Data_Paciente = ?";
                
                if ($stmtPaciente = $conn->prepare($queryPaciente)) {
                    $stmtPaciente->bind_param("i", $idPaciente);
                    $stmtPaciente->execute();
                    $resultPaciente = $stmtPaciente->get_result();
                    $paciente = $resultPaciente->fetch_assoc();
                    
                    // Mostrar información del paciente
                    echo "<h3>Información del Paciente</h3>";
                    echo "<table class='table-details'>";
                    echo "<tr><th>Nombre</th><td>" . $paciente['Nombre_Paciente'] . "</td></tr>";
                    echo "<tr><th>Fecha de Nacimiento</th><td>" . $paciente['Fecha_Nacimiento'] . "</td></tr>";
                    echo "<tr><th>Edad</th><td>" . $paciente['Edad'] . "</td></tr>";
                    echo "<tr><th>Sexo</th><td>" . $paciente['Sexo'] . "</td></tr>";
                    echo "<tr><th>Alergias</th><td>" . $paciente['Alergias'] . "</td></tr>";
                    echo "<tr><th>Teléfono</th><td>" . $paciente['Telefono'] . "</td></tr>";
                    echo "<tr><th>Correo</th><td>" . $paciente['Correo'] . "</td></tr>";
                    echo "</table>";
                    
                    // Mostrar información del expediente
                    echo "<h3>Expediente Médico</h3>";
                    echo "<table class='table-details'>";
                    echo "<tr><th>Antecedentes Personales</th><td>" . $expediente['Antecedentes_personales'] . "</td></tr>";
                    echo "<tr><th>Antecedentes Familiares</th><td>" . $expediente['Antecedentes_familiares'] . "</td></tr>";
                    echo "<tr><th>Medicamentos Actuales</th><td>" . $expediente['Medicamentos_actuales'] . "</td></tr>";
                    echo "<tr><th>Diagnósticos</th><td>" . $expediente['Diagnosticos'] . "</td></tr>";
                    echo "<tr><th>Estudios Realizados</th><td>" . $expediente['Estudios_realizados'] . "</td></tr>";
                    echo "<tr><th>Tratamientos</th><td>" . $expediente['Tratamientos'] . "</td></tr>";
                    echo "<tr><th>Notas</th><td>" . $expediente['Notas'] . "</td></tr>";
                    echo "<tr><th>Notas Adicionales</th><td>" . $expediente['Notas_adicionales'] . "</td></tr>";
                    echo "</table>";
                    
                    // Formulario para editar el expediente
                    echo "<h3>Editar Expediente Médico</h3>";
                    echo "<form method='POST' action=''>";
                    echo "<input type='hidden' name='id_expediente' value='" . $idExpediente . "'>";
                    echo "<div class='form-group'><label for='antecedentes_personales'>Antecedentes Personales:</label><textarea id='antecedentes_personales' name='antecedentes_personales' class='form-control' required>" . $expediente['Antecedentes_personales'] . "</textarea></div>";
                    echo "<div class='form-group'><label for='antecedentes_familiares'>Antecedentes Familiares:</label><textarea id='antecedentes_familiares' name='antecedentes_familiares' class='form-control' required>" . $expediente['Antecedentes_familiares'] . "</textarea></div>";
                    echo "<div class='form-group'><label for='medicamentos_actuales'>Medicamentos Actuales:</label><textarea id='medicamentos_actuales' name='medicamentos_actuales' class='form-control' required>" . $expediente['Medicamentos_actuales'] . "</textarea></div>";
                    echo "<div class='form-group'><label for='diagnosticos'>Diagnósticos:</label><textarea id='diagnosticos' name='diagnosticos' class='form-control' required>" . $expediente['Diagnosticos'] . "</textarea></div>";
                    echo "<div class='form-group'><label for='estudios_realizados'>Estudios Realizados:</label><textarea id='estudios_realizados' name='estudios_realizados' class='form-control' required>" . $expediente['Estudios_realizados'] . "</textarea></div>";
                    echo "<div class='form-group'><label for='tratamientos'>Tratamientos:</label><textarea id='tratamientos' name='tratamientos' class='form-control' required>" . $expediente['Tratamientos'] . "</textarea></div>";
                    echo "<div class='form-group'><label for='notas'>Notas:</label><textarea id='notas' name='notas' class='form-control' required>" . $expediente['Notas'] . "</textarea></div>";
                    echo "<div class='form-group'><label for='notas_adicionales'>Notas Adicionales:</label><textarea id='notas_adicionales' name='notas_adicionales' class='form-control' required>" . $expediente['Notas_adicionales'] . "</textarea></div>";
                    echo "<button type='submit' name='editar_expediente' class='btn btn-primary'>Actualizar Expediente</button>";
                    echo "</form>";
                    
                    // Obtener y mostrar consultas asociadas
                    echo "<h3>Consultas</h3>";
                    $queryConsultas = "SELECT * FROM Consultas WHERE Id_expediente = ?";
                    
                    if ($stmtConsultas = $conn->prepare($queryConsultas)) {
                        $stmtConsultas->bind_param("i", $idExpediente);
                        $stmtConsultas->execute();
                        $resultConsultas = $stmtConsultas->get_result();
                        
                        if ($resultConsultas->num_rows > 0) {
                            echo "<table class='table-details'>";
                            echo "<thead><tr><th>Fecha</th><th>Motivo</th><th>Observaciones</th><th>Diagnóstico</th><th>Tratamiento</th><th>Estudios</th><th>Recomendaciones</th><th>Médico</th></tr></thead>";
                            echo "<tbody>";
                            
                            while ($consulta = $resultConsultas->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $consulta['Fecha_consulta'] . "</td>";
                                echo "<td>" . $consulta['Motivo_consulta'] . "</td>";
                                echo "<td>" . $consulta['Observaciones'] . "</td>";
                                echo "<td>" . $consulta['Diagnostico'] . "</td>";
                                echo "<td>" . $consulta['Tratamiento'] . "</td>";
                                echo "<td>" . $consulta['Estudios'] . "</td>";
                                echo "<td>" . $consulta['Recomendaciones'] . "</td>";
                                echo "<td>" . $consulta['Medico'] . "</td>";
                                echo "</tr>";
                            }
                            
                            echo "</tbody></table>";
                        } else {
                            echo "<p>No hay consultas registradas para este expediente.</p>";
                        }
                        
                        $stmtConsultas->close();
                    } else {
                        echo "<p>Error al preparar la consulta de consultas.</p>";
                    }
                    
                    $stmtPaciente->close();
                } else {
                    echo "<p>Error al preparar la consulta de paciente.</p>";
                }
            } else {
                echo "<p>No se encontró el expediente.</p>";
            }
            
            $stmt->close();
        } else {
            echo "<p>Error al preparar la consulta de expediente.</p>";
        }
      } else {
        echo "<p>ID de expediente no proporcionado.</p>";
      }
      ?>
    </div>
  </div>
</div>

<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>
</body>
</html>
