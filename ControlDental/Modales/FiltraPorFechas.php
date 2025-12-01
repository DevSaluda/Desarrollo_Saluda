<div class="modal fade bd-example-modal-xl" id="FiltraPorFechas" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-primary">
        <div class="modal-content">
            <div class="modal-header">
            <p class="heading lead">Filtrar Por Rango de Fechas<i class="fas fa-calendar-alt"></i></p><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2>Seleccionar Rango de Fechas</h2>
                <form id="formFiltroFechas" method="GET">
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha Inicio:</label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="<?php echo date('Y-01-01'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin">Fecha Fin:</label>
                        <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="<?php echo date('Y-12-31'); ?>" required>
                    </div>
                    <button type="button" class="btn btn-primary" id="btnAplicarFiltro" onclick="if(typeof AplicarFiltroFechas === 'function') { AplicarFiltroFechas(); } else { alert('Función no disponible. Recargue la página.'); }">
                        <i class="fas fa-filter"></i> Aplicar Filtro
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
// Script inline como respaldo para asegurar que funcione
$(document).ready(function() {
    // Asegurar que el botón tenga el event listener
    $('#btnAplicarFiltro').off('click').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log("Click en botón desde script inline");
        if (typeof AplicarFiltroFechas === 'function') {
            AplicarFiltroFechas();
        } else {
            console.error("AplicarFiltroFechas no está definida");
            alert("Error: La función de filtrado no está disponible. Por favor, recargue la página.");
        }
        return false;
    });
});
</script>

