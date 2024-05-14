<div class="modal fade" id="CitaExt" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-success">
    <div class="modal-content">
      <div class="modal-header">
        <p class="heading lead" id="Titulo">Agendamiento de cita de laboratorio</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <span id="Aviso" class="text-semibold">Estimado usuario, verifique los campos antes de realizar alguna acción</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>

        <form action="javascript:void(0)" method="post" id="AgendaExternoRevaloraciones">
          <div class="row">
            <div class="col">
              <label for="nombresExt">Nombre del paciente</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" name="NombresExt" id="nombresExt">
              </div>
            </div>
            <div class="col">
              <label for="telExt">Teléfono</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                </div>
                <input type="text" class="form-control" name="TelExt" id="telExt">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label for="sucursal">Sucursal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-building"></i></span>
                </div>
                <select class="form-control" id="sucursal" name="Sucursal">
                  <option value="">Selecciona una sucursal</option>
                  <?php
          $query = $conn -> query ("SELECT Nombre_Sucursal,ID_SucursalC FROM  SucursalesCorre");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
        ?> 
                </select>
              </div>
            </div>
            <div class="col">
              <label for="LabAgendado">Laboratorio</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-flask"></i></span>
                </div>
                <select class="form-control" id="LabAgendado" name="LabAgendado">
                  <option value="">Selecciona un laboratorio</option>
                  <?php
          $query = $conn -> query ("SELECT Nombre_Prod,ID_Prod_POS,Tipo_Servicio FROM  Productos_POS WHERE Productos_POS.Tipo_Servicio = '00000000012'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_Prod_POS"].'">'.$valores["Nombre_Prod"].'</option>';
          }
        ?> 
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label for="fecha">Fecha</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                </div>
                <input type="date" class="form-control" name="Fecha" id="fecha">
              </div>
            </div>
            <div class="col">
              <label for="Hora">Hora</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i the class="fas fa-clock"></i></span>
                </div>
                <input type="time" class="form-control" id="Hora" name="Hora">
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-success">Confirmar datos <i class="fas fa-user-check"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>
