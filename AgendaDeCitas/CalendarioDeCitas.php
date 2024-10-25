<?php
include "Consultas/Consultas.php";



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Citas</title>
    
  <?php include "Header.php"?>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <style>
        /* Estilos personalizados */
        #calendar {
            max-width: 90%;
            margin: auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }
        .fc-event {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: transform 0.2s ease;
        }
        .fc-event:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<?php include_once ("Menu.php")?>
<div class="container my-4">
    <!-- Filtro para especialistas y sucursales -->
    <form id="filter-form" class="mb-3">
        <select id="especialista-select" class="custom-select w-auto">
            <option value="">Selecciona Especialista</option>
            <!-- Opciones dinámicas de PHP (más adelante) -->
        </select>
        <select id="sucursal-select" class="custom-select w-auto ml-2">
            <option value="">Selecciona Sucursal</option>
            <!-- Opciones dinámicas de PHP (más adelante) -->
        </select>
        <button type="button" id="filter-btn" class="btn btn-primary ml-2">Filtrar</button>
    </form>

    <!-- Contenedor del calendario -->
    <div id="calendar"></div>
</div>

<!-- Modal para los detalles de la cita -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eventModalLabel">Detalles de la Cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body-content">
        <!-- Detalles de la cita se mostrarán aquí -->
      </div>
    </div>
  </div>
</div>

<?php
  

  include ("footer.php")?>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Configuración de FullCalendar
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: function(fetchInfo, successCallback, failureCallback) {
                $.ajax({
                    url: 'Consultas/fetch_events.php',
                    method: 'POST',
                    data: {
                        especialista: $('#especialista-select').val(),
                        sucursal: $('#sucursal-select').val()
                    },
                    success: function(data) {
                        successCallback(data);
                    },
                    error: function() {
                        failureCallback();
                    }
                });
            },
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                $('#eventModal').modal('show');
                document.getElementById('modal-body-content').innerHTML = `
                    <p><strong>Especialidad:</strong> ${info.event.title}</p>
                    <p><strong>Paciente:</strong> ${info.event.extendedProps.nombrePaciente}</p>
                    <p><strong>Fecha y Hora:</strong> ${info.event.start.toLocaleString()}</p>
                    <p><strong>Sucursal:</strong> ${info.event.extendedProps.nombreSucursal}</p>
                    <p><strong>Observaciones:</strong> ${info.event.extendedProps.observaciones}</p>
                `;
            }
        });
        calendar.render();

        // Acción de filtro
        $('#filter-btn').on('click', function() {
            calendar.refetchEvents();
        });
    });
</script>
</body>
</html>
