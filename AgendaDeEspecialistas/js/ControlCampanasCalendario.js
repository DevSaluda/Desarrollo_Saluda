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

      console.log('Eventos cargados:', info);

      var e = info.event;
      var details =
        '<b>Paciente:</b> ' + e.title + '<br>' +
        '<b>Teléfono:</b> ' + (e.extendedProps.telefono || '-') + '<br>' +
        '<b>Especialidad:</b> ' + (e.extendedProps.especialidad || '-') + '<br>' +
        '<b>Doctor:</b> ' + (e.extendedProps.doctor || '-') + '<br>' +
        '<b>Sucursal:</b> ' + (e.extendedProps.sucursal || '-') + '<br>' +
        '<b>Observaciones:</b> ' + (e.extendedProps.observaciones || '-');

      // Mostrar detalles en el modal Bootstrap
      var modal = document.getElementById('modalDetalleCita');
      var modalBody = modal.querySelector('.modal-body');
      modalBody.innerHTML = details;
      modal.style.display = 'block';
    }
  });
  calendar.render();
});
