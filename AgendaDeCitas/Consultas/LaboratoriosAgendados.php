<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agendamiento de laboratorios</title>
  <!-- Agrega los enlaces a las librerías necesarias -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="text-center">
      <h2>Lista de Citas</h2>
    </div>
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
          function fechaCastellano ($fecha) {
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
            return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
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
                  ORDER BY Agenda_Labs.Fecha ASC";
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
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
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
      $('.lab-option').click(function(e) {
        e.preventDefault();
        var labType = $(this).data('lab');
        var nombre = $(this).closest('tr').find('.nombre').text();
        var telefono = $(this).closest('tr').find('.telefono').text();
        var fecha = $(this).closest('tr').find('td:eq(3)').text();
        var hora = $(this).closest('tr').find('td:eq(4)').text();
        var sucursal = $(this).closest('tr').find('td:eq(5)').text();
        var mensajeBase = '¡Hola ' + nombre + '! Queremos recordarte lo importante que es darle seguimiento a tu salud. Te invitamos a asistir a tu laboratorio programado';
        var mensaje = mensajeBase + ' el ' + fecha + ' a las ' + hora + ' en ' + sucursal + '.';
        switch (labType) {
          case 'sangre':
            mensaje += ' Recuerda no ingerir alimentos grasos antes de la prueba.';
            break;
          case 'urocultivo':
            mensaje += ' Es importante que recolectes la muestra de orina correctamente.';
            break;
          case 'coprologicos':
            mensaje += ' Recuerda seguir las indicaciones para la recolección de la muestra de heces.';
            break;
          case 'isopados':
            mensaje += ' No olvides seguir las instrucciones para la toma de muestra.';
            break;
          case 'exudados':
            mensaje += ' Se te recomienda no usar cremas o lociones en la zona a examinar.';
            break;
        }
        var whatsappLink = 'https://api.whatsapp.com/send?phone=+52' + telefono + '&text=' + encodeURIComponent(mensaje);
        window.open(whatsappLink, '_blank');
      });
    });
  </script>
</body>
</html>
