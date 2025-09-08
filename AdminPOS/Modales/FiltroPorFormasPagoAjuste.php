<div class="modal fade" id="FiltroPorFormasPagoAjuste" tabindex="-1" role="dialog" aria-labelledby="FiltroPorFormasPagoAjusteLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-warning">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Filtrar por Formas de Pago <i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
      <div class="modal-body">
     
 <form method="POST" action="javascript:void(0)" id="formFiltroFormasPago">
    
  <div class="row">
    <div class="col-md-6">
    <label for="formaPago">Forma de Pago</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="FormaPago"><i class="fas fa-credit-card"></i></span>
  </div>
  <select name="formaPago" id="formaPago" class="form-control">
  <option value="">Todas las formas de pago</option>
  <option value="Efectivo">Efectivo</option>
  <option value="Tarjeta">Tarjeta</option>
  <option value="Transferencia">Transferencia</option>
  <option value="Cheque">Cheque</option>
  <option value="Credito">Crédito</option>
  <option value="Vale">Vale</option>
  </select>
    </div>
    </div>
    
    <div class="col-md-6">
    <label for="tipoFiltro">Tipo de Filtro</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="TipoFiltro"><i class="fas fa-filter"></i></span>
  </div>
  <select name="tipoFiltro" id="tipoFiltro" class="form-control">
  <option value="contiene">Contiene esta forma de pago</option>
  <option value="solo">Solo esta forma de pago</option>
  <option value="multiples">Múltiples formas de pago</option>
  <option value="simples">Forma de pago simple</option>
  </select>
    </div>
    </div>
  </div>
  
  <div class="form-group">
    <label>Filtros Rápidos:</label>
    <div class="btn-group" role="group">
      <button type="button" class="btn btn-sm btn-outline-success" onclick="setFiltroRapido('multiples')">
        <i class="fas fa-layer-group"></i> Múltiples Pagos
      </button>
      <button type="button" class="btn btn-sm btn-outline-primary" onclick="setFiltroRapido('efectivo')">
        <i class="fas fa-money-bill"></i> Efectivo
      </button>
      <button type="button" class="btn btn-sm btn-outline-info" onclick="setFiltroRapido('tarjeta')">
        <i class="fas fa-credit-card"></i> Tarjeta
      </button>
      <button type="button" class="btn btn-sm btn-outline-warning" onclick="setFiltroRapido('transferencia')">
        <i class="fas fa-exchange-alt"></i> Transferencia
      </button>
    </div>
  </div>
  
  <div class="alert alert-info">
    <h6><i class="fas fa-info-circle"></i> Información:</h6>
    <ul class="mb-0">
      <li><strong>Contiene:</strong> Tickets que incluyen esta forma de pago (puede tener otras)</li>
      <li><strong>Solo:</strong> Tickets que únicamente usan esta forma de pago</li>
      <li><strong>Múltiples:</strong> Tickets con más de una forma de pago</li>
      <li><strong>Simples:</strong> Tickets con una sola forma de pago</li>
    </ul>
  </div>
  
      <button type="submit" class="btn btn-warning">
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
    // Manejar envío del formulario
    $('#formFiltroFormasPago').on('submit', function(e) {
        e.preventDefault();
        
        var formaPago = $('#formaPago').val();
        var tipoFiltro = $('#tipoFiltro').val();
        
        // Llamar a la función de filtrado
        filtrarPorFormaPago(formaPago, tipoFiltro);
        
        // Cerrar modal
        $('#FiltroPorFormasPagoAjuste').modal('hide');
    });
});

// Función para establecer filtros rápidos
function setFiltroRapido(tipo) {
    switch(tipo) {
        case 'multiples':
            $('#formaPago').val('');
            $('#tipoFiltro').val('multiples');
            break;
        case 'efectivo':
            $('#formaPago').val('Efectivo');
            $('#tipoFiltro').val('contiene');
            break;
        case 'tarjeta':
            $('#formaPago').val('Tarjeta');
            $('#tipoFiltro').val('contiene');
            break;
        case 'transferencia':
            $('#formaPago').val('Transferencia');
            $('#tipoFiltro').val('contiene');
            break;
    }
}

// Función para filtrar por forma de pago (modificada para incluir tipo de filtro)
function filtrarPorFormaPago(formaPago, tipoFiltro) {
    $.ajax({
        url: 'Consultas/ConsultaAjusteTickets.php',
        type: 'POST',
        data: {
            accion: 'filtrar_forma_pago',
            formaPago: formaPago,
            tipoFiltro: tipoFiltro
        },
        beforeSend: function() {
            $('#TableAjusteTickets').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Filtrando...</div>');
        },
        success: function(response) {
            $('#TableAjusteTickets').html(response);
            // Reinicializar DataTable si existe
            if ($.fn.DataTable) {
                $('#tablaAjusteTickets').DataTable().destroy();
                $('#tablaAjusteTickets').DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                    },
                    "order": [[0, "desc"]],
                    "pageLength": 25
                });
            }
        },
        error: function() {
            $('#TableAjusteTickets').html('<div class="alert alert-danger">Error al filtrar</div>');
        }
    });
}
</script>
