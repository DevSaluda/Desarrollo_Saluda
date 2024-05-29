<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agendamiento de laboratorios</title>
  <!-- Agrega los enlaces a las librerías necesarias -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    .dropdown-toggle {
      padding: 5px 10px;
      font-size: 14px;
      background-color: #25d366;
      color: white;
    }
    .dropdown-toggle .whatsapp-icon {
      margin-right: 5px;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="table-responsive">
      <table id="CitasExteriores" class="table table-hover">
        <thead>
          <tr>
            <th>Folio</th>
            <th>Paciente</th>
            <th>Telefono</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Sucursal</th>
            <th>Laboratorio Agendado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <!-- Aquí se generarán las filas de la tabla con datos dinámicos -->
          <?php
          function fechaCastellano($fecha) {
            $fecha = substr($fecha, 0, 10);
            $numeroDia = date('d', strtotime($fecha));
            $dia = date('l', strtotime($fecha));
            $mes = date('F', strtotime($fecha));
            $anio = date('Y', strtotime($fecha));
            $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
            $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
            $nombredia = str_replace($dias_EN, $dias_ES, $dia);
            $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
            return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
          }

          // Incluye el código PHP para obtener los datos de la base de datos
          // y generar las filas de la tabla
          include "db_connection.php";
          include "Consultas.php";
          $user_id = null;
          $sql1 = "SELECT Agenda_Labs.Id_genda, Agenda_Labs.Nombres_Apellidos, Agenda_Labs.Telefono, 
                  Agenda_Labs.Fk_sucursal, Agenda_Labs.Hora, Agenda_Labs.Fecha, Agenda_Labs.LabAgendado, 
                  Agenda_Labs.Agrego, Agenda_Labs.AgregadoEl, SucursalesCorre.ID_SucursalC, 
                  SucursalesCorre.Nombre_Sucursal FROM Agenda_Labs, SucursalesCorre 
                  WHERE SucursalesCorre.ID_SucursalC = Agenda_Labs.Fk_sucursal
                  ORDER BY Agenda_Labs.Fecha DESC";
          $query = $conn->query($sql1);
          if ($query->num_rows > 0):
            while ($Usuarios = $query->fetch_array()):
          ?>
          <tr>
            <td><?php echo $Usuarios["Id_genda"]; ?></td>
            <td class="nombre"><?php echo $Usuarios["Nombres_Apellidos"]; ?></td>
            <td class="telefono"><?php echo $Usuarios["Telefono"]; ?></td>
            <td><?php echo fechaCastellano($Usuarios["Fecha"]); ?></td>
            <td><?php echo $Usuarios["Hora"]; ?></td>
            <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
            <td><?php echo $Usuarios["LabAgendado"]; ?></td>
            <td>
              <!-- Botón Dropdown -->
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="whatsapp-icon" width="16" height="16" alt="WhatsApp">
                  Seleccione el tipo de laboratorio
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item lab-option" href="#" data-lab="sangre">Laboratorio de Sangre</a>
                  <a class="dropdown-item lab-option" href="#" data-lab="urocultivo">Urocultivo</a>
                  <a class="dropdown-item lab-option" href="#" data-lab="coprologicos">Coprologicos</a>
                  <a class="dropdown-item lab-option" href="#" data-lab="isopados">Isopados</a>
                  <a class="dropdown-item lab-option" href="#" data-lab="exudados">Exudados</a>
                </div>
              </div>
            </td>
          </tr>
          <?php
            endwhile;
          else:
          ?>
          <tr>
            <td colspan="8" class="text-center">Por el momento no hay citas</td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      var table = $('#CitasExteriores').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "pageLength": 10,
        "order": [[3, "desc"]],
        "language": {
          "paginate": {
            "previous": "Anterior",
            "next": "Siguiente"
          },
          "search": "Buscar:",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
          "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
          "zeroRecords": "No se encontraron resultados",
          "infoFiltered": "(filtrado de _MAX_ entradas totales)"
        }
      });

      function attachDropdownHandlers() {
        $('.lab-option').off('click').on('click', function(e) {
          e.preventDefault();
          var labType = $(this).data('lab');
          var nombre = $(this).closest('tr').find('.nombre').text();
          var telefono = $(this).closest('tr').find('.telefono').text();
          var fecha = $(this).closest('tr').find('td:eq(3)').text();
          var hora = $(this).closest('tr').find('td:eq(4)').text();
          var sucursal = $(this).closest('tr').find('td:eq(5)').text();
          var mensajeBase = '¡Hola ' + nombre + '! Queremos recordarte lo importante que es darle seguimiento a tu salud. 👩🏻‍⚕🧑🏻‍⚕%0A Te invitamos a asistir a tu laboratorio programado el día ' + fecha + ' a las ' + hora + ' en la Sucursal ' + sucursal + '.%0A¿Podrías confirmar tu asistencia? Tu bienestar es nuestra prioridad.%0A';
          var recomendaciones = '';
          switch (labType) {
            case 'colesterol,trigliceridos,lipidos':
              recomendaciones += 'Recomendaciones: Realizar ayuno de 8 horas.%0AEvitar consumir alimentos grasosos o abundantes por lo menos 24 horas antes de los ánalisis.';
              break;
            case 'sangre':
              recomendaciones += 'Recomendaciones: Realizar ayuno de 8 horas.%0ANo realizar ejercicio intenso antes de la toma.';
              break;
            case 'urocultivo':
              recomendaciones += 'Recomendaciones: Lavar la zona genital con agua y jabón antes de recolectar la muestra de orina.%0ARecoger la muestra a mitad de la micción.';
              break;
            case 'coprologicos':
              recomendaciones += 'Recomendaciones: Recolectar la muestra en un recipiente limpio y seco.%0AEvitar el contacto con la orina.';
              break;
            case 'isopados':
              recomendaciones += 'Recomendaciones: Evitar el uso de antibióticos al menos 48 horas antes de la toma de la muestra, a menos que el médico indique lo contrario.';
              break;
            case 'exudados':
              recomendaciones += 'Recomendaciones: No usar cremas o lociones en la zona a examinar antes de la toma de la muestra.%0AEvitar el uso de duchas vaginales en caso de exudado vaginal.';
              break;
            case 'antidoping':
              recomendaciones += 'Recomendaciones: Informar al personal sobre cualquier medicamento o suplemento que esté tomando.';
              break;
            case 'prequirurgicos':
              recomendaciones += 'Recomendaciones: Presentarse con ayuno de 8 horas para los estudios de sangre.%0AEvitar el uso de maquillaje, cremas o lociones el día de los estudios.';
              break;
            case 'pruebaCOVID':
              recomendaciones += 'Recomendaciones: No consumir alimentos ni bebidas al menos 30 minutos antes de la toma de la muestra.%0AInformar si ha tenido síntomas recientes de COVID-19.';
              break;
            case 'pruebaETS':
              recomendaciones += 'Recomendaciones: Abstenerse de tener relaciones sexuales al menos 24 horas antes de la toma de la muestra.%0AEvitar el uso de cremas, lociones o medicamentos en la zona genital.';
              break;
            case 'pruebaInfluenza':
              recomendaciones += 'Recomendaciones: No consumir alimentos ni bebidas al menos 30 minutos antes de la toma de la muestra.%0AEvitar el uso de medicamentos que puedan interferir con la prueba.';
              break;
            case 'panelHormonal':
              recomendaciones += 'Recomendaciones: Informar sobre el uso de anticonceptivos o tratamientos hormonales.%0AEvitar realizar ejercicio intenso antes de la toma de la muestra.';
              break;
            case 'pruebasHepaticas':
              recomendaciones += 'Recomendaciones: Realizar ayuno de 8 horas.%0AEvitar consumir alcohol al menos 24 horas antes de los análisis.';
              break;
            case 'glucosa':
              recomendaciones += 'Recomendaciones: Realizar ayuno de 8 horas.%0AEvitar consumir alimentos o bebidas azucaradas antes de la prueba.';
              break;
            case 'perfilTiroideo':
              recomendaciones += 'Recomendaciones: Informar sobre el uso de medicamentos para la tiroides.%0AEvitar consumir alimentos o bebidas al menos 4 horas antes de la toma de la muestra.';
              break;
            case 'electrolitos':
              recomendaciones += 'Recomendaciones: Realizar ayuno de 8 horas.%0AEvitar el consumo de bebidas deportivas o suplementos antes de la prueba.';
              break;
            case 'perfilRenal':
              recomendaciones += 'Recomendaciones: Realizar ayuno de 8 horas.%0AEvitar el consumo de alimentos ricos en proteínas antes de la prueba.';
              break;
            case 'perfilLipidico':
              recomendaciones += 'Recomendaciones: Realizar ayuno de 8 horas.%0AEvitar el consumo de alimentos grasos antes de la prueba.';
              break;
          }
          var mensaje = mensajeBase + recomendaciones;
          var whatsappLink = 'https://api.whatsapp.com/send?phone=+52' + telefono + '&text=' + encodeURIComponent(mensaje);
          window.open(whatsappLink, '_blank');
        });
      }

      attachDropdownHandlers();

      table.on('draw.dt', function() {
        attachDropdownHandlers();
      });
    });
  </script>
</body>
</html>
