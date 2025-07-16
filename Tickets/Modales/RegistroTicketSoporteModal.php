<div class="modal fade" id="RegistroTicketSoporteModal" tabindex="-1" role="dialog" style="overflow-y: auto;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di" class="modal-dialog modal-lg modal-notify modal-success">
    <div class="modal-content">
      <div class="modal-header">
        <p class="heading lead" id="Titulo">Registro de Ticket de Soporte</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <div id="Mensaje" class="alert alert-info alert-styled-left text-blue-800 content-group">
        <span id="Aviso" class="text-semibold">Estimado usuario, verifique los campos antes de realizar alguna acción</span>
        <button type="button" class="close" data-dismiss="alert">×</button>
      </div>
      <div class="modal-body">
        <div class="text-center">
        <form id="RegistroTicketSoporteForm" method="POST">


            <div class="row">
              <div class="col">
                <label for="sucursalExt">Sucursal</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital"></i></span>
                  </div>
                  <select id="sucursalExt" class="form-control" name="SucursalExt" required>
                    <option value="">Seleccione una Sucursal:</option>
                    <?php
                      $query = $conn->query("SELECT ID_SucursalC,Nombre_Sucursal FROM SucursalesCorre WHERE Nombre_Sucursal !='Matriz'");
                      while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="'.$valores["Nombre_Sucursal"].'">'.$valores["Nombre_Sucursal"].'</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="tipoProblema">Seleccione el tipo de problema</label>
              <select class="form-control" name="Problematica" id="tipoProblema" required onchange="mostrarCampoFolioCorreccion()">
                <option value="">Seleccione...</option>
                <option value="POS">Punto de Venta</option>
                <option value="Teléfono">Teléfono</option>
                <option value="Computadora">Computadora</option>
                <option value="Wifi/Internet">Wifi/Internet</option>
                <option value="Impresora">Impresora</option>
                <option value="Huellas">Huellas</option>
                <option value="Terminal Bancaria">Terminal Bancaria</option>
                <option value="Teléfono Fijo">Teléfono Fijo</option>
                <option value="Tableta">Tableta</option>
                <option value="Accesorios">Accesorios</option>
                <option value="Programas/Software">Programas/Software</option>
                <option value="Otros">Otros</option>
<option value="Corrección de Ticket">Corrección de Ticket</option>
              </select>
            </div>

            <div class="form-group">
              <label for="DescripcionProblematica">Descripción de la problemática</label>
              <textarea class="form-control" id="DescripcionProblematica" name="DescripcionProblematica" rows="5" placeholder="Describa brevemente la problemática con detalles relevantes." required></textarea>
            </div>

            <div class="form-group">
  <label for="folioEmpleado">Folio de Empleado</label>
  <input type="text" class="form-control" id="folioEmpleado" name="FolioEmpleado" placeholder="Ingrese su folio" pattern="[A-Za-z0-9]+" title="Solo letras y números" required>
</div>
<div class="form-group">
  <label for="nombreEmpleado">Nombre de quien reporta</label>
  <input type="text" class="form-control" id="nombreEmpleado" name="NombreEmpleado" placeholder="Ingrese su nombre" required>
</div>
<input type="hidden" id="agregadoPor" name="Agregado_Por">

            <div class="form-group" id="campoFolioCorreccion" style="display:none;">
              <label for="folioCorreccion">Folio del Ticket a corregir</label>
              <input type="text" class="form-control" id="folioCorreccion" name="FolioCorreccion" placeholder="Ingrese el folio del ticket" />
            </div>

            <input type="hidden" name="Fecha" value="<?php echo date('Y-m-d'); ?>">

            <div class="text-center">
              <button type="submit" id="submitTicketSoporte" class="btn btn-success">Guardar Ticket <i class="fas fa-check"></i></button>
            </div>
          </form>
<script>
function mostrarCampoFolioCorreccion() {
  var tipo = document.getElementById('tipoProblema').value;
  var campo = document.getElementById('campoFolioCorreccion');
  if(tipo === 'Corrección de Ticket') {
    campo.style.display = 'block';
    document.getElementById('folioCorreccion').required = true;
  } else {
    campo.style.display = 'none';
    document.getElementById('folioCorreccion').required = false;
  }
}
</script>
        </div>
      </div>
    </div>
  </div>
</div>