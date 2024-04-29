<form method="POST" action="https://saludapos.com/JefaturaEnfermeria/Consultas/FiltraPorRangoFechas.php">
  <div class="row">
    <div class="col">
      <label for="FechaInicio">Fecha Inicio</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="iconoFechaInicio"><i class="far fa-hospital"></i></span>
        </div>
        <input type="date" class="form-control" name="FechaInicio" required>
      </div>
    </div>
    <div class="col">
      <label for="FechaFin">Fecha de Fin</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="iconoFechaFin"><i class="far fa-hospital"></i></span>
        </div>
        <input type="date" class="form-control" name="FechaFin" required>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-success">Realizar búsqueda <i class="fas fa-exchange-alt"></i></button>
</form>
