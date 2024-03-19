<div class="modal fade bd-example-modal-xl" id="FiltroPorProducto" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success">
        <div class="modal-content">
            <div class="text-center">
                <div class="modal-header">
                    <h5 class="modal-title">Filtrado de ventas por sucursal <i class="fas fa-credit-card"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="FiltroPorProducto" method="POST">
                        <div class="form-row">
           
                        <div class="col">
                                <label for="añosSelect">Seleccione un producto a buscar</label>
                                <select id="buscador" style="width: 300px;">
        <option value="">Selecciona un producto</option>
    </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Realizar Busqueda <i class="fas fa-exchange-alt"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


