<?php
include "Consultas/Consultas.php";
include "Header.php";
include "dbconect.php";
// Obtener los datos del expediente si se ha proporcionado un ID
$expediente = null;
if (isset($_GET['id'])) {
    $idExpediente = $_GET['id'];
    $query = "SELECT * FROM Expediente_Medico WHERE Id_expediente = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idExpediente);
    $stmt->execute();
    $result = $stmt->get_result();
    $expediente = $result->fetch_assoc();
    $stmt->close();
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idExpediente = $_POST['id_expediente'];
    $antecedentesPersonales = $_POST['antecedentes_personales'];
    $antecedentesFamiliares = $_POST['antecedentes_familiares'];
    $medicamentosActuales = $_POST['medicamentos_actuales'];
    $diagnosticos = $_POST['diagnosticos'];
    $estudiosRealizados = $_POST['estudios_realizados'];
    $tratamientos = $_POST['tratamientos'];
    $notas = $_POST['notas'];
    $medicoResponsable = $_POST['medico_responsable'];
    $notasAdicionales = $_POST['notas_adicionales'];

    $query = "UPDATE Expediente_Medico SET 
                Antecedentes_personales = ?, 
                Antecedentes_familiares = ?, 
                Medicamentos_actuales = ?, 
                Diagnosticos = ?, 
                Estudios_realizados = ?, 
                Tratamientos = ?, 
                Notas = ?, 
                Medico_responsable = ?, 
                Notas_adicionales = ?
              WHERE Id_expediente = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssi", 
        $antecedentesPersonales, 
        $antecedentesFamiliares, 
        $medicamentosActuales, 
        $diagnosticos, 
        $estudiosRealizados, 
        $tratamientos, 
        $notas, 
        $medicoResponsable, 
        $notasAdicionales, 
        $idExpediente
    );
    
    if ($stmt->execute()) {
        echo "<script>alert('Expediente actualizado exitosamente.'); window.location.href = 'Expedientes.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el expediente.');</script>";
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

  <title>Editar Expediente | <?php echo $row['ID_H_O_D']?> <?php echo $row['Nombre_Sucursal']?> </title>

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
      Editar Expediente Médico
    </div>
    <div class="card-body">
      <?php if ($expediente): ?>
      <form method="POST" action="">
        <input type="hidden" name="id_expediente" value="<?php echo $expediente['Id_expediente']; ?>">
        <div class="form-group">
          <label for="antecedentes_personales">Antecedentes Personales:</label>
          <textarea id="antecedentes_personales" name="antecedentes_personales" class="form-control" required><?php echo $expediente['Antecedentes_personales']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="antecedentes_familiares">Antecedentes Familiares:</label>
          <textarea id="antecedentes_familiares" name="antecedentes_familiares" class="form-control" required><?php echo $expediente['Antecedentes_familiares']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="medicamentos_actuales">Medicamentos Actuales:</label>
          <textarea id="medicamentos_actuales" name="medicamentos_actuales" class="form-control" required><?php echo $expediente['Medicamentos_actuales']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="diagnosticos">Diagnósticos:</label>
          <textarea id="diagnosticos" name="diagnosticos" class="form-control" required><?php echo $expediente['Diagnosticos']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="estudios_realizados">Estudios Realizados:</label>
          <textarea id="estudios_realizados" name="estudios_realizados" class="form-control" required><?php echo $expediente['Estudios_realizados']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="tratamientos">Tratamientos:</label>
          <textarea id="tratamientos" name="tratamientos" class="form-control" required><?php echo $expediente['Tratamientos']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="notas">Notas:</label>
          <textarea id="notas" name="notas" class="form-control" required><?php echo $expediente['Notas']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="medico_responsable">Médico Responsable:</label>
          <select id="medico_responsable" name="medico_responsable" class="form-control" required>
            <?php
            $queryMedicos = "SELECT Medico_ID, Nombre FROM Personal_Medico";
            $resultMedicos = $conn->query($queryMedicos);
            while ($medico = $resultMedicos->fetch_assoc()) {
              $selected = $expediente['Medico_responsable'] == $medico['Medico_ID'] ? 'selected' : '';
              echo "<option value='" . $medico['Medico_ID'] . "' $selected>" . $medico['Nombre'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="notas_adicionales">Notas Adicionales:</label>
          <textarea id="notas_adicionales" name="notas_adicionales" class="form-control" required><?php echo $expediente['Notas_adicionales']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Expediente</button>
      </form>
      <?php else: ?>
      <p class="text-danger">No se encontró el expediente.</p>
      <?php endif; ?>
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
