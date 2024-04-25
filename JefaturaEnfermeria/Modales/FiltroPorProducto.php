<!-- Ajustes en el HTML -->
<div class="modal fade bd-example-modal-xl" id="FiltroPorProducto" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success">
        <div class="modal-content">
            <div class="text-center">
                <div class="modal-header">
                    <h5 class="modal-title">Filtrado de ventas por producto <i class="fas fa-credit-card"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="FiltroPorProducto" method="POST">
                        <div class="form-row">
                            <div class="col">
                                <label for="buscador">Seleccione un producto a buscar</label>
                                <select class="form-control" id="buscador" style="width: 300px;">
                                    <option value="">Ingrese un código o nombre</option>
                                </select>
                            </div>
                        </div>


<input type="text" id="nombreprod" class="form-control" placeholder="Nombre del producto" />
<input type="text" id="codbarra"  class="form-control" placeholder="Código de barras" />
                        <button type="submit" class="btn btn-success">Realizar Búsqueda <i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ajustes en el script JavaScript -->

