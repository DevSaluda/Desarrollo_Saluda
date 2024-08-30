<div class="modal fade" id="RegistroMantenimientoModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di" class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
      <div class="modal-header">
        <p class="heading lead" id="Titulo">Registro de Mantenimiento</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <div id="Mensaje" class="alert alert-info alert-styled-left text-blue-800 content-group">
        <span id="Aviso" class="text-semibold">Estimado usuario, verifique los campos antes de realizar alguna acción</span>
        <button type="button" class="close" data-dismiss="alert">×</button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <form enctype="multipart/form-data" id="RegistroMantenimientoForm">
            <div class="form-group">
              <label for="tipoEquipo">Seleccione el tipo de equipo</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                </div>
                <select class="form-control" name="tipoEquipo" id="tipoEquipo" required>
                  <option value="">Seleccione...</option>
                  <option value="Computadora">Computadora</option>
                  <option value="Laptop">Laptop</option>
                  <option value="Impresora">Impresora</option>
                  <option value="Tablet">Tablet</option>
                  <option value="Celular">Celular</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="Comentario">Comentario</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-comment"></i></span>
                </div>
                <textarea class="form-control" id="Comentario" name="Comentario" rows="3"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="file">Agregar imágenes</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input type="file" class="form-control" name="file[]" id="file" multiple aria-describedby="basic-addon1">
              </div>
            </div>
            <input type="hidden" name="Fecha" value="<?php echo date('Y-m-d'); ?>">
            <input type="hidden" class="form-control" name="Registro" id="registro" value="<?php echo $row['Nombre_Apellidos']?>" readonly>
            <input type="hidden" class="form-control" name="Sucursal" id="sucursal" value="<?php echo $row['Nombre_Sucursal']?>" readonly>
            <input type="hidden" class="form-control" name="Empresa" id="Empresa" value="<?php echo $row['ID_H_O_D']?>" readonly>
            <div class="text-center">
              <button type="submit" name="submit_Mantenimiento" id="submit_Mantenimiento" class="btn btn-success">Confirmar datos <i class="fas fa-check"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
