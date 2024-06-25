<?php
include "Consultas/Consultas.php";
include "Header.php";
include "dbconect.php";
// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombrePaciente = $_POST['nombre_paciente'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];
    $antecedentesPersonales = $_POST['antecedentes_personales'];
    $antecedentesFamiliares = $_POST['antecedentes_familiares'];
    $medicamentosActuales = $_POST['medicamentos_actuales'];
    $diagnosticos = $_POST['diagnosticos'];
    $estudiosRealizados = $_POST['estudios_realizados'];
    $tratamientos = $_POST['tratamientos'];
    $notas = $_POST['notas'];
    $medicoResponsable = $_POST['medico_responsable'];
    $notasAdicionales = $_POST['notas_adicionales'];

    $query = "INSERT INTO Expediente_Medico 
              (Nombre_Paciente, Fecha_nacimiento, Sexo, Telefono, Antecedentes_personales, Antecedentes_familiares, Medicamentos_actuales, Diagnosticos, Estudios_realizados, Tratamientos, Notas, Medico_responsable, Notas_adicionales, Fecha_ultima_modificacion)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssssss", 
        $nombrePaciente,
        $fechaNacimiento,
        $sexo,
        $telefono,
        $antecedentesPersonales,
        $antecedentesFamiliares,
        $medicamentosActuales,
        $diagnosticos,
        $estudiosRealizados,
        $tratamientos,
        $notas,
        $medicoResponsable,
        $notasAdicionales
    );
    
    if ($stmt->execute()) {
        echo "<script>alert('Expediente creado exitosamente.'); window.location.href = 'Expedientes.php';</script>";
    } else {
        echo "<script>alert('Error al crear el expediente.');</script>";
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Crear Expediente | <?php echo $row['ID_H_O_D']?> <?php echo $row['Nombre_Sucursal']?> </title>

  <style>
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      font-weight: bold;
    }
    .form-control {
      width: 100%;
    }
    .btn-primary {
      background-color: #0057b8;
      border: none;
    }
    .btn-primary:hover {
      background-color: #004494;
    }
  </style>
</head>
<body>

<?php include_once ("Menu.php")?>

<div class="container">
  <div class="card">
    <div class="card-header" style="background-color: #0057b8; color: white;">
      Crear Expediente Médico
    </div>
    <div class="card-body">
      <form method="POST" action="">
        <div class="form-group">
          <label for="nombre_paciente">Nombre del Paciente:</label>
          <input type="text" id="nombre_paciente" name="nombre_paciente" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
          <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="sexo">Sexo:</label>
          <select id="sexo" name="sexo" class="form-control" required>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Otro">Otro</option>
          </select>
        </div>
        <div class="form-group">
          <label for="telefono">Teléfono:</label>
          <input type="text" id="telefono" name="telefono" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="antecedentes_personales">Antecedentes Personales:</label>
          <textarea id="antecedentes_personales" name="antecedentes_personales" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="antecedentes_familiares">Antecedentes Familiares:</label>
          <textarea id="antecedentes_familiares" name="antecedentes_familiares" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="medicamentos_actuales">Medicamentos Actuales:</label>
          <textarea id="medicamentos_actuales" name="medicamentos_actuales" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="diagnosticos">Diagnósticos:</label>
          <textarea id="diagnosticos" name="diagnosticos" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="estudios_realizados">Estudios Realizados:</label>
          <textarea id="estudios_realizados" name="estudios_realizados" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="tratamientos">Tratamientos:</label>
          <textarea id="tratamientos" name="tratamientos" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="notas">Notas:</label>
          <textarea id="notas" name="notas" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="medico_responsable">Médico Responsable:</label>
          <select id="medico_responsable" name="medico_responsable" class="form-control" required>
            <?php
            $queryMedicos = "SELECT Medico_ID, Nombre FROM Personal_Medico";
            $resultMedicos = $conn->query($queryMedicos);
            while ($medico = $resultMedicos->fetch_assoc()) {
              echo "<option value='" . $medico['Medico_ID'] . "'>" . $medico['Nombre'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="notas_adicionales">Notas Adicionales:</label>
          <textarea id="notas_adicionales" name="notas_adicionales" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Crear Expediente</button>
      </form>
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
