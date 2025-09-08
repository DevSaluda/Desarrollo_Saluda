<div class="modal fade" id="FiltroPorFechasAjuste" tabindex="-1" role="dialog" aria-labelledby="FiltroPorFechasAjusteLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-info">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Filtrar por Rango de Fechas <i class="fas fa-calendar"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
      <div class="modal-body">
     
 <form method="POST" action="javascript:void(0)" id="formFiltroFechas">
    
  <div class="row">
    <div class="col">
    <label for="fechaInicio">Fecha Inicio</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="FechaInicio"><i class="fas fa-calendar-alt"></i></span>
  </div>
  <input type="date" class="form-control" name="fechaInicio" id="fechaInicio" required>
    </div>
    </div>
    
    <div class="col">
    <label for="fechaFin">Fecha Fin</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="FechaFin"><i class="fas fa-calendar-alt"></i></span>
  </div>
  <input type="date" class="form-control" name="fechaFin" id="fechaFin" required>
    </div>
    </div>
  </div>
  
  <div class="form-group">
    <label>Filtros Rápidos:</label>
    <div class="btn-group" role="group">
      <button type="button" class="btn btn-sm btn-outline-primary" onclick="setFechasRapidas('hoy')">Hoy</button>
      <button type="button" class="btn btn-sm btn-outline-primary" onclick="setFechasRapidas('ayer')">Ayer</button>
      <button type="button" class="btn btn-sm btn-outline-primary" onclick="setFechasRapidas('semana')">Esta Semana</button>
      <button type="button" class="btn btn-sm btn-outline-primary" onclick="setFechasRapidas('mes')">Este Mes</button>
    </div>
  </div>
  
      <button type="submit" class="btn btn-info">
        <i class="fas fa-search"></i> Filtrar Tickets
      </button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">
        <i class="fas fa-times"></i> Cancelar
      </button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>

<script>
$(document).ready(function() {
    // Establecer fechas por defecto (últimos 7 días)
    var hoy = new Date();
    var hace7Dias = new Date();
    hace7Dias.setDate(hoy.getDate() - 7);
    
    $('#fechaFin').val(hoy.toISOString().split('T')[0]);
    $('#fechaInicio').val(hace7Dias.toISOString().split('T')[0]);
    
    // Manejar envío del formulario
    $('#formFiltroFechas').on('submit', function(e) {
        e.preventDefault();
        
        var fechaInicio = $('#fechaInicio').val();
        var fechaFin = $('#fechaFin').val();
        
        if (!fechaInicio || !fechaFin) {
            alert('Por favor seleccione ambas fechas');
            return;
        }
        
        if (new Date(fechaInicio) > new Date(fechaFin)) {
            alert('La fecha de inicio no puede ser mayor a la fecha fin');
            return;
        }
        
        // Llamar a la función de filtrado
        filtrarPorFechas(fechaInicio, fechaFin);
        
        // Cerrar modal
        $('#FiltroPorFechasAjuste').modal('hide');
    });
});

// Función para establecer fechas rápidas
function setFechasRapidas(tipo) {
    var hoy = new Date();
    var fechaInicio, fechaFin;
    
    switch(tipo) {
        case 'hoy':
            fechaInicio = fechaFin = hoy.toISOString().split('T')[0];
            break;
        case 'ayer':
            var ayer = new Date();
            ayer.setDate(hoy.getDate() - 1);
            fechaInicio = fechaFin = ayer.toISOString().split('T')[0];
            break;
        case 'semana':
            var inicioSemana = new Date();
            inicioSemana.setDate(hoy.getDate() - hoy.getDay());
            fechaInicio = inicioSemana.toISOString().split('T')[0];
            fechaFin = hoy.toISOString().split('T')[0];
            break;
        case 'mes':
            var inicioMes = new Date();
            inicioMes.setDate(1);
            fechaInicio = inicioMes.toISOString().split('T')[0];
            fechaFin = hoy.toISOString().split('T')[0];
            break;
    }
    
    $('#fechaInicio').val(fechaInicio);
    $('#fechaFin').val(fechaFin);
}
</script>
