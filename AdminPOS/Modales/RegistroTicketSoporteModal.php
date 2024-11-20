<div class="modal fade" id="RegistroTicketSoporteModal" tabindex="-1" role="dialog" style="overflow-y: auto;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di" class="modal-dialog modal-lg modal-notify modal-success">
    <div class="modal-content">
      <div class="modal-header">
        <p class="heading lead" id="Titulo">Registro de Ticket de Soporte</p>
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
          <form id="RegistroTicketSoporteForm">
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
                <textarea class="form-control" id="DescripcionProblematica" name="DescripcionProblematica" rows="5" style="resize: vertical;" placeholder="Describa brevemente la problemática con detalles relevantes." required></textarea>
              </div>
            </div>

            <!-- Campos ocultos -->
            <input type="hidden" name="Fecha" value="<?php echo date('Y-m-d'); ?>">
            <input type="hidden" class="form-control" name="Agregado_Por" id="registro" value="<?php echo $row['Nombre_Apellidos']?>" readonly>
            <input type="hidden" class="form-control" name="Sucursal" id="sucursal" value="<?php echo $row['Nombre_Sucursal']?>" readonly>
            <input type="hidden" class="form-control" name="ID_H_O_D" id="Empresa" value="<?php echo $row['ID_H_O_D']?>" readonly>

            <!-- Botón de envío -->
            <div class="text-center">
              <button type="submit" id="submitTicketSoporte" class="btn btn-success">Guardar Ticket <i class="fas fa-check"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
