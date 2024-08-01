<div class="modal fade bd-example-modal-xl" id="FiltroTraspasos" tabindex="-1" role="dialog"
  aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-primary">
    <div class="modal-content">

      <div class="text-center">
        <div class="modal-header">
          <p class="heading lead">Busqueda de traspasos por fechas<i class="fas fa-credit-card"></i></p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <form method="POST" action="https://saludapos.com/CEDISMOVIL/TraspasosPorFechasV2">




            <div class="row">
              <div class="col">
                <label for="exampleFormControlInput1">Fecha inicio </label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend"> <span class="input-group-text" id="Tarjeta"><i
                        class="far fa-hospital"></i></span>
                  </div>
                  <input type="date" class="form-control " name="Fecha1">
                </div>
              </div>

              <div class="col">
                <label for="exampleFormControlInput1">Fecha fin </label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend"> <span class="input-group-text" id="Tarjeta"><i
                        class="far fa-hospital"></i></span>
                  </div>
                  <input type="date" class="form-control " name="Fecha2">
                </div>


                <div> </div>
              </div>
            </div>
            <button type="submit" id="submit_registroarea" value="Guardar" class="btn btn-success">Realizar busqueda <i
                class="fas fa-exchange-alt"></i></button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
</div>