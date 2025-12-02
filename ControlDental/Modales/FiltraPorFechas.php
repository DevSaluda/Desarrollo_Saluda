<div class="modal fade bd-example-modal-xl" id="FiltraPorFechas" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
      <div class="text-center">
        <div class="modal-header">
          <p class="heading lead">Filtrado por rango de fechas <i class="fas fa-calendar-alt"></i></p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formFiltroFechas" method="GET">
            <div class="row">
              <div class="col">
                <label for="fecha_inicio">Fecha inicio</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
                  </div>
                  <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php 
                    if (isset($_GET['fecha_inicio'])) {
                        echo htmlspecialchars($_GET['fecha_inicio']);
                    } else {
                        echo date('Y-01-01');
                    }
                  ?>" required>
                </div>
              </div>
              <div class="col">
                <label for="fecha_fin">Fecha fin</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
                  </div>
                  <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php 
                    if (isset($_GET['fecha_fin'])) {
                        echo htmlspecialchars($_GET['fecha_fin']);
                    } else {
                        echo date('Y-12-31');
                    }
                  ?>" required>
                </div>
              </div>
            </div>
            <button type="button" id="btnAplicarFiltro" class="btn btn-success" onclick="if(typeof AplicarFiltroFechas === 'function') { AplicarFiltroFechas(); } else { alert('Error: La función no está disponible. Recargue la página.'); }">
              Consultar <i class="fas fa-exchange-alt"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

