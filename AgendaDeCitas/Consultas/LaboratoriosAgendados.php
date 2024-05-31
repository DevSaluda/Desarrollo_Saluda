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
    .whatsapp-button {
      padding: 5px 10px;
      font-size: 14px;
      background-color: #25d366;
      color: white;
      border: none;
      cursor: pointer;
    }
    .whatsapp-button .whatsapp-icon {
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
                  WHERE SucursalesCorre.ID_SucursalC = Agenda_Labs.Fk_sucursal";
          $query = $conn->query($sql1);
          if ($query->num_rows > 0):
            while ($Usuarios = $query->fetch_array()):
          ?>
          <tr>
            <td><?php echo $Usuarios["Id_genda"]; ?></td>
            <td class="nombre"><?php echo $Usuarios["Nombres_Apellidos"]; ?></td>
            <td class="telefono"><?php echo $Usuarios["Telefono"]; ?></td>
            <td data-order="<?php echo date('Y-m-d', strtotime($Usuarios["Fecha"])); ?>"><?php echo fechaCastellano($Usuarios["Fecha"]); ?></td>
            <td><?php echo $Usuarios["Hora"]; ?></td>
            <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
            <td><?php echo $Usuarios["LabAgendado"]; ?></td>
            <td>
              <!-- Botón para abrir el modal -->
              <button class="btn whatsapp-button" data-toggle="modal" data-target="#labModal" data-id="<?php echo $Usuarios["Id_genda"]; ?>">
                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="whatsapp-icon" width="16" height="16" alt="WhatsApp">
                Seleccione el tipo de laboratorio
              </button>
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

  <!-- Modal -->
  <div class="modal fade" id="labModal" tabindex="-1" role="dialog" aria-labelledby="labModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labModalLabel">Seleccione el tipo de laboratorio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="labForm">
            <div class="form-group">
              <label><input type="checkbox" name="labs" value="Hematológicos Generales"> Hematológicos Generales</label><br>
              <label><input type="checkbox" name="labs" value="Orina/Uroánalisis"> Orina/Uroánalisis</label><br>
              <label><input type="checkbox" name="labs" value="Heces/Coporanálisis"> Heces/Coporanálisis</label><br>
              <label><input type="checkbox" name="labs" value="Cultivos: Orina"> Cultivos: Orina</label><br>
              <label><input type="checkbox" name="labs" value="Cultivos: Heces"> Cultivos: Heces</label><br>
              <label><input type="checkbox" name="labs" value="Cultivos: Faringeo"> Cultivos: Faringeo</label><br>
              <label><input type="checkbox" name="labs" value="Cultivos: Vaginal/Vulvar"> Cultivos: Vaginal/Vulvar</label><br>
              <label><input type="checkbox" name="labs" value="Cultivos: Herida"> Cultivos: Herida</label><br>
              <label><input type="checkbox" name="labs" value="Cultivos: Oidos"> Cultivos: Oidos</label><br>
              <label><input type="checkbox" name="labs" value="Cultivos: Ojos"> Cultivos: Ojos</label>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="sendMessage">Enviar Mensaje</button>
        </div>
      </div>
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

      $('#labModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que abrió el modal
        var id = button.data('id'); // Extrae información del atributo data-*
        var modal = $(this);

        $('#sendMessage').off('click').on('click', function() {
          var selectedLabs = [];
          modal.find('input[name="labs"]:checked').each(function() {
            selectedLabs.push($(this).val());
          });

          var row = button.closest('tr');
          var nombre = row.find('.nombre').text();
          var telefono = row.find('.telefono').text();
          var fecha = row.find('td:eq(3)').text();
          var hora = row.find('td:eq(4)').text();
          var sucursal = row.find('td:eq(5)').text();
          var mensajeBase = '¡Hola ' + nombre + '! Queremos recordarte lo importante que es darle seguimiento a tu salud. 👩🏻‍⚕🧑🏻‍⚕ Te invitamos a asistir a tu laboratorio programado el día ' + fecha + ' a las ' + hora + ' en la Sucursal ' + sucursal + '. ¿Podrías confirmar tu asistencia? Tu bienestar es nuestra prioridad. ';
          var recomendaciones = '';

          selectedLabs.forEach(function(lab) {
            switch (lab) {
              case 'Hematológicos Generales':
                recomendaciones += 'Recomendaciones para Hematológicos Generales: Realizar ayuno de 8 horas. ';
                break;
              case 'Orina/Uroánalisis':
                recomendaciones += 'Recomendaciones para Orina/Uroánalisis: Lavar la zona genital antes de recolectar la muestra. ';
                break;
              case 'Heces/Coporanálisis':
                recomendaciones += 'Recomendaciones para Heces/Coporanálisis: Recolectar la muestra en un recipiente limpio y seco. ';
                break;
              case 'Cultivos: Orina':
                recomendaciones += 'Recomendaciones para Cultivos de Orina: Lavar la zona genital y recolectar la muestra a mitad de la micción. ';
                break;
              case 'Cultivos: Heces':
                recomendaciones += 'Recomendaciones para Cultivos de Heces: Recolectar la muestra en un recipiente limpio y seco. ';
                break;
              case 'Cultivos: Faringeo':
                recomendaciones += 'Recomendaciones para Cultivos Faringeos: No comer ni beber al menos 30 minutos antes de la toma de la muestra. ';
                break;
              case 'Cultivos: Vaginal/Vulvar':
                recomendaciones += 'Recomendaciones para Cultivos Vaginal/Vulvar: No usar cremas o lociones en la zona antes de la toma de la muestra. ';
                break;
              case 'Cultivos: Herida':
                recomendaciones += 'Recomendaciones para Cultivos de Herida: No aplicar medicamentos tópicos antes de la toma de la muestra. ';
                break;
              case 'Cultivos: Oidos':
                recomendaciones += 'Recomendaciones para Cultivos de Oídos: No limpiar los oídos antes de la toma de la muestra. ';
                break;
              case 'Cultivos: Ojos':
                recomendaciones += 'Recomendaciones para Cultivos de Ojos: No usar colirios antes de la toma de la muestra. ';
                break;
              default:
                recomendaciones += '';
                break;
            }
          });

          var mensaje = mensajeBase + recomendaciones;
          var url = 'https://wa.me/' + telefono + '?text=' + encodeURIComponent(mensaje);

          window.open(url, '_blank');
          $('#labModal').modal('hide');
        });
      });
    });
  </script>
</body>
</html>
