<div class="modal fade bd-example-modal-xl" id="BajaDeInventarios" tabindex="-1" role="dialog"
  aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-primary">
    <div class="modal-content">

      <div class="text-center">
        <div class="modal-header">
          <p class="heading lead">Busqueda de inventarios por fechas<i class="fas fa-credit-card"></i></p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <form method="POST" action="https://saludapos.com/AdminPOS/ResultadoDeCierresDeInventarios">




            <div class="row">
            <div class="col">
    <label for="sucursalSelect">Sucursal</label>
    <select id="sucursalSelect" class="form-control" name="sucursal">
        <option value="">Seleccione una sucursal</option>
    </select>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch("https://saludapos.com/AdminPOS/Consultas/BuscaSucursalesDeCierre.php")
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById("sucursalSelect");
            data.forEach(sucursal => {
                const option = document.createElement("option");
                option.value = sucursal.id;
                option.text = sucursal.nombre;
                select.add(option);
            });
        })
        .catch(error => console.error('Error:', error));
});
</script>

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