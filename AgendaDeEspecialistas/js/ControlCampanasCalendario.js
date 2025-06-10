document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'es',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    },
    events: '../AgendaDeEspecialistas/Consultas/CitasEnSucursalExtDias.php',
    
    eventClick: function(info) {
      var e = info.event;
      // Mostrar detalles como tabla Bootstrap
      var tabla = '<table class="table table-bordered">';
      tabla += '<tr><th>Paciente</th><td>' + (e.title || '-') + '</td></tr>';
      tabla += '<tr><th>Teléfono</th><td>' + (e.extendedProps.telefono || '-') + '</td></tr>';
      tabla += '<tr><th>Especialidad</th><td>' + (e.extendedProps.especialidad || '-') + '</td></tr>';
      tabla += '<tr><th>Doctor</th><td>' + (e.extendedProps.doctor || '-') + '</td></tr>';
      tabla += '<tr><th>Sucursal</th><td>' + (e.extendedProps.sucursal || '-') + '</td></tr>';
      tabla += '<tr><th>Observaciones</th><td>' + (e.extendedProps.observaciones || '-') + '</td></tr>';
      tabla += '</table>';
      // Botón de eliminar cita
      tabla += '<button id="btn-eliminar-cita" class="btn btn-danger w-100 mt-3">Eliminar cita</button>';
      document.getElementById('modalDetalleCitaBody').innerHTML = tabla;
      var modalEl = document.getElementById('modalDetalleCita');
      var modal = new bootstrap.Modal(modalEl);
      modal.show();

      // Delegar el evento de eliminar
      setTimeout(function(){ // Asegura que el DOM esté actualizado
        var btnEliminar = document.getElementById('btn-eliminar-cita');
        if(btnEliminar) {
          btnEliminar.onclick = function() {
            if(confirm('¿Seguro que deseas eliminar esta cita?')) {
              fetch('Consultas/EliminaCitaExt.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'idcancelaExt=' + encodeURIComponent(e.id)
              })
              .then(response => response.json())
              .then(data => {
                if (data.statusCode == 200) {
                  modal.hide();
                  calendar.refetchEvents();
                  alert('Cita eliminada correctamente.');
                } else {
                  alert('Error al eliminar la cita');
                }
              })
              .catch(error => {
                alert('Error al eliminar la cita');
              });
            }
          }
        }
      }, 100);

    }
  });
  calendar.render();
});
