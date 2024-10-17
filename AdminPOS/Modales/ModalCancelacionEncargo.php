<!-- modal_cancelacion.php -->
<div class="modal fade" id="cancelarModal" tabindex="-1" role="dialog" aria-labelledby="cancelarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelarModalLabel">Cancelar Productos Seleccionados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Escribe el motivo de la cancelación:</p>
        <textarea id="motivoCancelacion" class="form-control" rows="4"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="confirmarCancelacionBtn" class="btn btn-danger">Confirmar Cancelación</button>
      </div>
    </div>
  </div>
</div>
