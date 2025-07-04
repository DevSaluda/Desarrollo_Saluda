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
    events: function(fetchInfo, successCallback, failureCallback) {
      // Obtener los estados seleccionados
      let estados = [];
      if (typeof obtenerEstadosSeleccionados === 'function') {
        estados = obtenerEstadosSeleccionados();
      } else if (window.obtenerEstadosSeleccionados) {
        estados = window.obtenerEstadosSeleccionados();
      }
      // Construir la URL con los parámetros de estado
      let url = '../AgendaDeEspecialistas/Consultas/CitasEnSucursalExtDias.php?start=' + encodeURIComponent(fetchInfo.startStr) + '&end=' + encodeURIComponent(fetchInfo.endStr);
      if (estados.length > 0) {
        url += '&estados=' + encodeURIComponent(estados.join(','));
      }
      fetch(url)
        .then(response => response.json())
        .then(events => successCallback(events))
        .catch(error => failureCallback(error));
    },

    
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
      // Estado con badge de color
      var color = e.backgroundColor || e.color || '#6c757d';
      var estado = e.extendedProps.estado || '-';
      tabla += '<tr><th>Estado</th><td><span class="badge" style="background-color:' + color + ';color:white;">' + estado + '</span></td></tr>';
      tabla += '</table>';
      document.getElementById('modalDetalleCitaBody').innerHTML = tabla;
      // Agrega el botón al footer del modal sin sobrescribir el de cerrar
      var modalFooter = document.querySelector('#modalDetalleCita .modal-footer');
      if (modalFooter) {
        // Si ya existe el botón, no lo agregues de nuevo
        if (!document.getElementById('btn-eliminar-cita')) {
          var btnEliminar = document.createElement('button');
          btnEliminar.id = 'btn-eliminar-cita';
          btnEliminar.className = 'btn btn-danger ms-2';
          btnEliminar.innerText = 'Eliminar cita';
          modalFooter.appendChild(btnEliminar);
        }
      }
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
  // Guardar el calendario globalmente para recarga desde el filtro
  window.calendarGlobal = calendar;

  // Búsqueda por nombre
  document.getElementById('btnBuscarCita').addEventListener('click', function() {
    filtrarPorNombre();
  });
  document.getElementById('busquedaNombreCita').addEventListener('keyup', function(e) {
    if (e.key === 'Enter') filtrarPorNombre();
    if (this.value === '') filtrarPorNombre(); // Reset si borra todo
  });

  function filtrarPorNombre() {
    var texto = document.getElementById('busquedaNombreCita').value;
    var usuario = (typeof nombreUsuario !== 'undefined' ? nombreUsuario : '');
    calendar.removeAllEventSources();
    if (texto.trim() === '') {
      // Si está vacío, consulta el archivo original
      calendar.addEventSource('Consultas/CitasEnSucursalExtDias.php');
    } else {
      // Si hay texto, filtra usando el nuevo archivo PHP
      calendar.addEventSource(function(fetchInfo, successCallback, failureCallback) {
        var params = new URLSearchParams({ usuario: usuario, busqueda: texto });
        fetch('Consultas/FiltraCitasPorNombre.php?' + params.toString())
          .then(response => response.json())
          .then(events => {
            successCallback(events);
          })
          .catch(failureCallback);
      });
    }
  }
});
