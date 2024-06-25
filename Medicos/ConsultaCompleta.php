<?php
include "Consultas/Consultas.php";
include "Header.php";
include "dbconect.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Consulta Médica | <?php echo $row['ID_H_O_D']?> <?php echo $row['Nombre_Sucursal']?> </title>

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
      Detalles de la Consulta Médica
    </div>
    <div class="card-body">
      <?php
      if (isset($_GET['id'])) {
        $idConsulta = $_GET['id'];
        
        // Obtener información de la consulta
        $queryConsulta = "SELECT * FROM Consultas WHERE Id_consulta = $idConsulta";
        $resultConsulta = $conn->query($queryConsulta);
        
        if ($resultConsulta->num_rows > 0) {
          $consulta = $resultConsulta->fetch_assoc();
          $idExpediente = $consulta['Id_expediente'];
          
          // Obtener información del expediente
          $queryExpediente = "SELECT * FROM Expediente_Medico WHERE Id_expediente = $idExpediente";
          $resultExpediente = $conn->query($queryExpediente);
          $expediente = $resultExpediente->fetch_assoc();
          
          // Obtener información del paciente
          $idPaciente = $expediente['Id_paciente'];
          $queryPaciente = "SELECT * FROM Data_Pacientes WHERE ID_Data_Paciente = $idPaciente";
          $resultPaciente = $conn->query($queryPaciente);
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
          
          // Mostrar información de la consulta
          echo "<h3>Detalles de la Consulta</h3>";
          echo "<table class='table-details'>";
          echo "<tr><th>Fecha de Consulta</th><td>" . $consulta['Fecha_consulta'] . "</td></tr>";
          echo "<tr><th>Motivo de Consulta</th><td>" . $consulta['Motivo_consulta'] . "</td></tr>";
          echo "<tr><th>Observaciones</th><td>" . $consulta['Observaciones'] . "</td></tr>";
          echo "<tr><th>Diagnóstico</th><td>" . $consulta['Diagnostico'] . "</td></tr>";
          echo "<tr><th>Tratamiento</th><td>" . $consulta['Tratamiento'] . "</td></tr>";
          echo "<tr><th>Estudios</th><td>" . $consulta['Estudios'] . "</td></tr>";
          echo "<tr><th>Recomendaciones</th><td>" . $consulta['Recomendaciones'] . "</td></tr>";
          echo "<tr><th>Médico</th><td>" . $consulta['Medico'] . "</td></tr>";
          echo "</table>";
          
        } else {
          echo "<p>No se encontró la consulta.</p>";
        }
      } else {
        echo "<p>ID de consulta no proporcionado.</p>";
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
