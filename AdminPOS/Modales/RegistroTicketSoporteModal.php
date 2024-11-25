<div class="modal fade" id="RegistroTicketSoporteModal" tabindex="-1" role="dialog" aria-labelledby="Titulo" aria-hidden="true" style="overflow-y: auto;">
  <div class="modal-dialog modal-lg modal-notify modal-success">
    <div class="modal-content">
      <!-- Encabezado -->
      <div class="modal-header">
        <h5 class="modal-title" id="Titulo">Registro de Ticket de Soporte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <!-- Mensaje informativo -->
      <div id="Mensaje" class="alert alert-info alert-styled-left text-blue-800 content-group">
        <span id="Aviso" class="text-semibold">Estimado usuario, verifique los campos antes de realizar alguna acción</span>
        <button type="button" class="close" data-dismiss="alert">×</button>
      </div>
      
      <!-- Cuerpo del modal -->
      <div class="modal-body">
        <form id="RegistroTicketSoporteForm" enctype="multipart/form-data">
          <!-- Tipo de problema -->
          <div class="form-group">
            <label for="tipoProblema">Seleccione el tipo de problema</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-exclamation-triangle"></i></span>
              </div>
              <select class="form-control" name="Problematica" id="tipoProblema" required>
                <option value="">Seleccione...</option>
                <option value="Conexión a internet">Conexión a internet</option>
                <option value="Problema con impresora">Problema con impresora</option>
                <option value="Actualización de software">Actualización de software</option>
                <option value="Otro">Otro</option>
              </select>
            </div>
          </div>

          <!-- Descripción de la problemática -->
          <div class="form-group">
            <label for="DescripcionProblematica">Descripción de la problemática</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-comment"></i></span>
              </div>
              <textarea class="form-control" id="DescripcionProblematica" name="DescripcionProblematica" rows="5" style="resize: vertical;" placeholder="Describa la problemática con detalles relevantes" required></textarea>
            </div>
          </div>

          <!-- Campo para cargar imágenes -->
          <div class="form-group">
            <label for="ImagenesSoporte">Subir imágenes (opcional)</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-upload"></i></span>
              </div>
              <input type="file" class="form-control" id="ImagenesSoporte" name="ImagenesSoporte[]" accept="image/*" multiple>
            </div>
            <small class="form-text text-muted">Puede seleccionar varias imágenes (máximo 5MB por archivo).</small>
          </div>

          <!-- Campos ocultos -->
          <input type="hidden" name="Fecha" value="<?php echo date('Y-m-d'); ?>">
          <input type="hidden" name="Agregado_Por" value="<?php echo $row['Nombre_Apellidos']; ?>" readonly>
          <input type="hidden" name="Sucursal" value="<?php echo $row['Nombre_Sucursal']; ?>" readonly>
          <input type="hidden" name="Empresa" value="<?php echo $row['ID_H_O_D']; ?>" readonly>

          <!-- Botón de envío -->
          <div class="text-center">
            <button type="submit" id="submitTicketSoporte" class="btn btn-success">
              Guardar Ticket <i class="fas fa-check"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
