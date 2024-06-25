<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Listado de Expedientes</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

  <!-- Estilos personalizados -->
  <style>
    /* Estilos para la tabla */
    #Expedientes th {
      font-size: 16px;
      background-color: #0057b8;
      color: white;
      padding: 10px;
      text-align: center;
    }

    #Expedientes td {
      font-size: 14px;
      padding: 8px;
      border-bottom: 1px solid #ccc;
      text-align: center;
    }

    /* Personalizar el diseño de la paginación con CSS */
    .dataTables_wrapper .dataTables_paginate {
      text-align: center !important;
      margin-top: 10px !important;
    }

    .dataTables_paginate .paginate_button {
      padding: 5px 10px !important;
      border: 1px solid #007bff !important;
      margin: 2px !important;
      cursor: pointer !important;
      font-size: 16px !important;
      color: #007bff !important;
      background-color: #fff !important;
    }

    /* Cambiar el color del paginado seleccionado */
    .dataTables_paginate .paginate_button.current {
      background-color: #007bff !important;
      color: #fff !important;
      border-color: #007bff !important;
    }

    /* Cambiar el color del hover */
    .dataTables_paginate .paginate_button:hover {
      background-color: #C80096 !important;
      color: #fff !important;
      border-color: #C80096 !important;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="card">
    <div class="card-header" style="background-color: #0057b8; color: white;">
      Listado de Expedientes
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="Expedientes" class="table table-hover">
          <thead>
            <tr>
              <th>ID Expediente</th>
              <th>Antecedentes Personales</th>
              <th>Antecedentes Familiares</th>
              <th>Medicamentos Actuales</th>
              <th>Diagnósticos</th>
              <th>Estudios Realizados</th>
              <th>Tratamientos</th>
              <th>Notas</th>
              <th>Notas Adicionales</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "db_connection.php"; // Incluye el archivo de conexión a la base de datos

            // Consulta para obtener la lista de expedientes
            $queryExpedientes = "SELECT * FROM Expediente_Medico";
            $resultExpedientes = $conn->query($queryExpedientes);

            if ($resultExpedientes->num_rows > 0) {
              while ($expediente = $resultExpedientes->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $expediente['Id_expediente'] . "</td>";
                echo "<td>" . $expediente['Antecedentes_personales'] . "</td>";
                echo "<td>" . $expediente['Antecedentes_familiares'] . "</td>";
                echo "<td>" . $expediente['Medicamentos_actuales'] . "</td>";
                echo "<td>" . $expediente['Diagnosticos'] . "</td>";
                echo "<td>" . $expediente['Estudios_realizados'] . "</td>";
                echo "<td>" . $expediente['Tratamientos'] . "</td>";
                echo "<td>" . $expediente['Notas'] . "</td>";
                echo "<td>" . $expediente['Notas_adicionales'] . "</td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='9'>No hay expedientes registrados.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- jQuery y Bootstrap JS (asegúrate de tener estos scripts incluidos) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script>
  // Inicializar DataTable
  $(document).ready(function() {
    $('#Expedientes').DataTable({
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "zeroRecords": "No se encontraron expedientes",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ expedientes",
        "infoEmpty": "No hay expedientes disponibles",
        "infoFiltered": "(filtrado de _MAX_ total expedientes)",
        "search": "Buscar:",
        "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      }
    });
  });
</script>

</body>
</html>
