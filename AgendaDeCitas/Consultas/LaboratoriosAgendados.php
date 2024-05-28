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
                  <a class="dropdown-item lab-option" href="#" data-lab="exudado faringeo">Exudado faringeo</a>
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
      $('#CitasExteriores').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "pageLength": 10,
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

      $('.lab-option').click(function(e) {
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
            recomendaciones += 'Recomendaciones: Realiza el aseo del área genital con abundante agua con jabón y seca de forma correcta.%0ARecolecta en un vaso copro la primera orina de la mañana.%0AEn pacientes pediátricos, se deberá asear con agua y con jabón, secar correctamente y colocar la bolsa recolectora de orina.%0AEvitar usar talcos,cremas,aceites o cualquier sustancia que pueda contaminar la muestra';
            break;
          case 'coprologicos':
            recomendaciones += 'Recomendaciones: Recolectar una cantidad de materia fecal del tamaño de una nuez y colocar dentro de un vaso copro.%0ASi la muestra es liquida solo se llena hasta la mitad.%0ASi la muestra se acompaña de moco y/o sangre eso deberá incluirse dentro de el vaso copro.%0AEvite contaminar la muestra con papel agua u orina. Cierre el vaso hermeticamente, coloquelo dentro de una bolsa y cierre perfectamente';
            break;
          case 'isopados':
            recomendaciones += 'Recomendaciones: Seguir las instrucciones para la toma de muestra.';
            break;
          case 'exudado faringeo':
            recomendaciones += 'Recomendaciones: Acudir sin haber ingerido liquidos o alimentos previamente.%0A Evitar lavarse los dientes y/o haber usado enjuague bucal.%0A Evitar masticar chicle o consumi cualquier pastilla para el alimento';
            break;
        }
        var mensaje = mensajeBase + recomendaciones;
        var whatsappLink = 'https://api.whatsapp.com/send?phone=+52' + telefono + '&text=' + encodeURIComponent(mensaje);
        window.open(whatsappLink, '_blank');
      });
    });
  </script>
</body>
</html>
