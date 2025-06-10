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
      var details =
        '<b>Paciente:</b> ' + e.title + '<br>' +
        '<b>Teléfono:</b> ' + (e.extendedProps.telefono || '-') + '<br>' +
        '<b>Especialidad:</b> ' + (e.extendedProps.especialidad || '-') + '<br>' +
        '<b>Doctor:</b> ' + (e.extendedProps.doctor || '-') + '<br>' +
        '<b>Sucursal:</b> ' + (e.extendedProps.sucursal || '-') + '<br>' +
        '<b>Observaciones:</b> ' + (e.extendedProps.observaciones || '-');

      // Usar el id correcto y la API Bootstrap 5
      document.getElementById('modalDetalleCitaBody').innerHTML = details;
      var modal = new bootstrap.Modal(document.getElementById('modalDetalleCita'));
      modal.show();
    }
  });
  calendar.render();
});
