<?php
include "Consultas/Consultas.php";
include "Header.php";
include "dbconect.php";
// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idExpediente = $_POST['id_expediente'];
  $motivoConsulta = $_POST['motivo_consulta'];
  $observaciones = $_POST['observaciones'];
  $diagnostico = $_POST['diagnostico'];
  $tratamiento = $_POST['tratamiento'];
  $estudios = $_POST['estudios'];
  $recomendaciones = $_POST['recomendaciones'];
  $medico = $_POST['medico'];

  $query = "INSERT INTO Consultas (Id_expediente, Fecha_consulta, Motivo_consulta, Observaciones, Diagnostico, Tratamiento, Estudios, Recomendaciones, Medico) 
            VALUES (?, CURRENT_TIMESTAMP, ?, ?, ?, ?, ?, ?, ?)";
  
  $stmt = $conn->prepare($query);
  $stmt->bind_param("isssssss", $idExpediente, $motivoConsulta, $observaciones, $diagnostico, $tratamiento, $estudios, $recomendaciones, $medico);
  
  if ($stmt->execute()) {
    echo "<script>alert('Consulta guardada exitosamente.'); window.location.href = 'Expedientes.php';</script>";
  } else {
    echo "<script>alert('Error al guardar la consulta.');</script>";
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

  <title>Nueva Consulta | <?php echo $row['ID_H_O_D']?> <?php echo $row['Nombre_Sucursal']?> </title>

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
      Nueva Consulta Médica
    </div>
    <div class="card-body">
      <form method="POST" action="">
        <div class="form-group">
          <label for="id_expediente">ID de Expediente:</label>
          <input type="number" id="id_expediente" name="id_expediente" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="motivo_consulta">Motivo de la Consulta:</label>
          <textarea id="motivo_consulta" name="motivo_consulta" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="observaciones">Observaciones:</label>
          <textarea id="observaciones" name="observaciones" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="diagnostico">Diagnóstico:</label>
          <textarea id="diagnostico" name="diagnostico" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="tratamiento">Tratamiento:</label>
          <textarea id="tratamiento" name="tratamiento" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="estudios">Estudios:</label>
          <textarea id="estudios" name="estudios" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="recomendaciones">Recomendaciones:</label>
          <textarea id="recomendaciones" name="recomendaciones" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="medico">Médico Responsable:</label>
          <select id="medico" name="medico" class="form-control" required>
            <?php
            $queryMedicos = "SELECT Medico_ID, Nombre FROM Personal_Medico";
            $resultMedicos = $conn->query($queryMedicos);
            while ($medico = $resultMedicos->fetch_assoc()) {
              echo "<option value='" . $medico['Medico_ID'] . "'>" . $medico['Nombre'] . "</option>";
            }
            ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Consulta</button>
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
