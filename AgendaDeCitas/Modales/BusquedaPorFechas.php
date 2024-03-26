<div class="modal fade bd-example-modal-xl" id="FiltroEspecificoMesxd" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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
                    <form action="FiltraCitasPorFechas" method="POST">
                        <div class="form-row">
                            <div class="col">
                                <label for="mesesSelect">Seleccione un mes</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="calendario"><i class="far fa-calendar"></i></span>
                                    </div>
                                    <input type="date" class="form-control" id="fechainicial" name="fechainicial">
                                </div>
                            </div>
                            <div class="col">
    <label for="fecha">Seleccione un año</label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="calendario"><i class="far fa-calendar"></i></span>
        </div>
        <input type="date" class="form-control" id="fechafin" name="fechafinal">

    </div>
</div>

                        </div>
                        <button type="submit" class="btn btn-success">Realizar Busqueda <i class="fas fa-exchange-alt"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


