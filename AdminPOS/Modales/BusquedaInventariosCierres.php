<div class="modal fade bd-example-modal-xl" id="BajaDeInventarios" tabindex="-1" role="dialog"
  aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-notify modal-info">
    <div class="modal-content">

      <div class="text-center">
        <div class="modal-header">
          <p class="heading lead">Busqueda de inventarios de cierre<i class="fas fa-credit-card"></i></p>

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
        <!-- Opciones de sucursal serán cargadas aquí -->
    </select>
</div>

<div class="col">
    <label for="fechaInventario">Fecha de Inventario</label>
    <select id="fechaInventario" class="form-control" name="FechaInventario">
        <option value="">Seleccione una fecha</option>
    </select>
</div>
<div class="col">
    <label for="sucursalDestino">Sucursal Destino</label>
    <select id="sucursalDestino" class="form-control" name="sucursalDestino">
        <option value="">Seleccione una sucursal</option>
    </select>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Cargar sucursales (esto ya lo tienes configurado en el script previo)
    fetch("https://saludapos.com/AdminPOS/Consultas/BuscaSucursalesDeCierre.php") // Ruta para obtener sucursales
        .then(response => response.json())
        .then(data => {
            const selectSucursal = document.getElementById("sucursalSelect");
            data.forEach(sucursal => {
                const option = document.createElement("option");
                option.value = sucursal.id;
                option.text = sucursal.nombre;
                selectSucursal.add(option);
            });
        })
        .catch(error => console.error('Error:', error));

    // Cargar fechas al seleccionar una sucursal
    document.getElementById("sucursalSelect").addEventListener("change", function() {
        const sucursalId = this.value;
        const selectFecha = document.getElementById("fechaInventario");
        selectFecha.innerHTML = '<option value="">Seleccione una fecha</option>';

        if (sucursalId) {
            fetch(`https://saludapos.com/AdminPOS/Consultas/BuscaFechasSucursalesBajaInventarios.php?sucursal_id=${sucursalId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(fecha => {
                        const option = document.createElement("option");
                        option.value = fecha;
                        option.text = fecha;
                        selectFecha.add(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    });
});


$(document).ready(function() {
    // Cargar sucursales en ambos selects
    $.ajax({
        url: 'https://saludapos.com/AdminPOS/Consultas/cargarSucursales.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            data.forEach(function(sucursal) {
                const option = `<option value="${sucursal.ID_SucursalC}">${sucursal.Nombre_Sucursal}</option>`;
                $('#sucursalSelect').append(option);     // Sucursal origen
                $('#sucursalDestino').append(option);    // Sucursal destino
            });
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar las sucursales:", error);
        }
    });
});

</script>

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