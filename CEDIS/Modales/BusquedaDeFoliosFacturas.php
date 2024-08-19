<div class="modal fade bd-example-modal-xl" id="FiltroDeFacturas" tabindex="-1" role="dialog"
  aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-primary">
    <div class="modal-content">

      <div class="text-center">
        <div class="modal-header">
          <p class="heading lead">Generacion de archivo para impresion<i class="fas fa-credit-card"></i></p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <form method="POST" action="https://saludapos.com/CEDIS/Preresultadoparaimpresionescedis">
            <div class="row">
            <!-- Columna para el select de sucursales -->
            <div class="col-md-6 mb-3">
                <label for="sucursal">Sucursal a elegir</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
                    </div>
                    <select id="sucursal" class="form-control" name="Sucursal" required>
                        <option value="">Seleccione una Sucursal:</option>
                        <?php 
                        // Asumiendo que $conn es tu conexión a la base de datos
                        $query = $conn->query("SELECT ID_SucursalC, Nombre_Sucursal, ID_H_O_D FROM SucursalesCorre WHERE ID_H_O_D='".$row['ID_H_O_D']."'");
                        while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
                        }
                        ?>  
                    </select>
                </div>
            </div>

            <!-- Columna para el select de facturas -->
            <div class="col-md-6 mb-3">
                <label for="facturas">Factura</label>
                <select id="facturas" class="form-control" name="Factura">
                    <option value="">Seleccione una Factura:</option>
                </select>
            </div>
        </div>
    </div>
    <script>
$(document).ready(function() {
    // Inicializa Select2 en el select de facturas
    $('#facturas').select2({
        placeholder: "Seleccione una Factura:",
        allowClear: true,
        width: '100%', // Asegura que el select ocupe todo el ancho disponible
        theme: "classic"
    });

    // Configura el evento change en el select de sucursales
    $('#sucursal').on('change', function() {
        var sucursal = $(this).val();
        if (sucursal) {
            $.ajax({
                url: 'https://saludapos.com/CEDIS/Consultas/obtener_resultados.php',
                type: 'POST',
                data: { sucursal: sucursal },
                success: function(response) {
                    // Limpia las opciones actuales
                    $('#facturas').empty();
                    // Añade la opción por defecto
                    $('#facturas').append('<option value="">Seleccione una Factura:</option>');
                    // Añade las nuevas opciones
                    $('#facturas').append(response);
                    // Actualiza Select2
                    $('#facturas').trigger('change');
                }
            });
        } else {
            $('#facturas').empty().append('<option value="">Seleccione una Factura:</option>').trigger('change');
        }
    });
});
</script>

            <button type="submit" id="submit_registroarea" value="Guardar" class="btn btn-success">Realizar busqueda <i
                class="fas fa-exchange-alt"></i></button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
</div>