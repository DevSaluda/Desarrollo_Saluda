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
    events: '../AgendaDeCitas/Consultas/CitasEnSucursalExtDias.php',
    eventClick: function(info) {
      var e = info.event;
      var details =
        '<b>Paciente:</b> ' + e.title + '<br>' +
        '<b>Teléfono:</b> ' + (e.extendedProps.telefono || '-') + '<br>' +
        '<b>Especialidad:</b> ' + (e.extendedProps.especialidad || '-') + '<br>' +
        '<b>Doctor:</b> ' + (e.extendedProps.doctor || '-') + '<br>' +
        '<b>Sucursal:</b> ' + (e.extendedProps.sucursal || '-') + '<br>' +
        '<b>Observaciones:</b> ' + (e.extendedProps.observaciones || '-');
      alert(details);
    }
  });
  calendar.render();
});

