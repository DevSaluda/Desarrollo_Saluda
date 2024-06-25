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
  $medico = $_POST['medico']; // El médico se selecciona automáticamente
  
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

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<?php include_once ("Menu.php")?>

<div class="wrapper">
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header" style="background-color: #0057b8; color: white;">
            Nueva Consulta Médica
          </div>
          <div class="card-body">
            <form method="POST" action="">
              <div class="form-group">
                <label for="id_expediente">ID de Expediente:</label>
                <input type="text" id="id_expediente" name="id_expediente" class="form-control" value="<?php echo obtenerNuevoIdExpediente(); ?>" readonly>
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
              <input type="text" class="form-control" name="medico" id="medico"  value="<?php echo $row['Nombre_Apellidos']?>"  hidden  readonly >
 

              <button type="submit" class="btn btn-primary">Guardar Consulta</button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE -->
  <script src="dist/js/adminlte.min.js"></script>
</body>
</html>

<?php
// Función para simular la obtención del nuevo ID de expediente (autoincremental)
function obtenerNuevoIdExpediente() {
  return 1; // Aquí deberías implementar la lógica real para obtener el próximo ID
}

// Función para simular la obtención del ID del médico logueado
function obtenerIdMedicoLogueado() {
  return 1; // Simplemente se devuelve un valor fijo, debes adaptarlo a tu lógica de autenticación
}
?>
