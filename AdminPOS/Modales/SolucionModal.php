<div class="modal fade" id="SolucionModal" tabindex="-1" role="dialog" aria-labelledby="SolucionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SolucionModalLabel">Actualizar Solución</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="SolucionForm">
                    <input type="hidden" id="ticketId" name="Id_Ticket">
                    <div class="form-group">
                        <label for="Solucion">Solución</label>
                        <textarea class="form-control" id="Solucion" name="Solucion" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Estatus">Estatus</label>
                        <select class="form-control" id="Estatus" name="Estatus" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Resuelto">Resuelto</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
