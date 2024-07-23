<div class="modal fade bd-example-modal-xl" id="FiltroDeFacturas" tabindex="-1" role="dialog"
  aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-primary">
    <div class="modal-content">

      <div class="text-center">
        <div class="modal-header">
          <p class="heading lead">Generacion de archivo para impresion<i class="fas fa-credit-card"></i></p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <form method="POST" action="https://saludapos.com/AdminPOS/Preresultadoparaimpresionescedis.php">
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
        document.getElementById('sucursal').addEventListener('change', function() {
            var sucursal = this.value;
            if (sucursal) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'https://saludapos.com/AdminPOS/Consultas/obtener_resultados.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById('facturas').innerHTML = xhr.responseText;
                    }
                };
                xhr.send('sucursal=' + encodeURIComponent(sucursal));
            } else {
                document.getElementById('facturas').innerHTML = '<option value="">Seleccione una Factura:</option>';
            }
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