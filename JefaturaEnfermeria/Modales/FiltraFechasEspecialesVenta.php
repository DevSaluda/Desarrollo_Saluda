<div class="modal fade bd-example-modal-xl" id="FiltroDeFechasVentas" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
      <div class="text-center">
        <div class="modal-header">
          <p class="heading lead">Filtrado de ventas por sucursal<i class="fas fa-credit-card"></i></p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="FechasReporteGenerado">
            <div class="row">
              <div class="col">
                <label for="FechaInicio">Fecha inicio</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="CalendarioInicio"><i class="fas fa-calendar-alt"></i></span>
                  </div>
                  <input type="date" class="form-control" name="Fecha1" id="FechaInicio">
                </div>
              </div>
              <div class="col">
                <label for="FechaFin">Fecha fin</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="CalendarioFin"><i class="fas fa-calendar-alt"></i></span>
                  </div>
                  <input type="date" class="form-control" name="Fecha2" id="FechaFin">
                </div>
              </div>
            </div>
            <button type="submit" id="submit_filtro_fechas" value="Consultar" class="btn btn-success">Consultar <i class="fas fa-search"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
