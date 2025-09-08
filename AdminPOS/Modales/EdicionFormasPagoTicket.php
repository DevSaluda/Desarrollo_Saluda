<?php
include "Consultas/db_connection.php";
include "Consultas/Consultas.php";

// Obtener datos del ticket
$folioTicket = isset($_POST["folioTicket"]) ? $_POST["folioTicket"] : '';
$folioSucursal = isset($_POST["foliosucursal"]) ? $_POST["foliosucursal"] : '';

if (empty($folioTicket) || empty($folioSucursal)) {
    echo '<div class="alert alert-danger">Error: No se proporcionaron los datos del ticket</div>';
    exit;
}

// Obtener información del ticket
$sql = "SELECT Ventas_POS.*, SucursalesCorre.Nombre_Sucursal 
        FROM Ventas_POS 
        INNER JOIN SucursalesCorre ON Ventas_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC
        WHERE Ventas_POS.Folio_Ticket = '$folioTicket' 
        AND Ventas_POS.FolioSucursal = '$folioSucursal' 
        LIMIT 1";

$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo '<div class="alert alert-danger">Error: No se encontró el ticket especificado</div>';
    exit;
}

$ticket = $result->fetch_assoc();

// Función para parsear formas de pago existentes
function parsearFormasPago($formasPagoString, $cantidadPago = 0) {
    $formas = [];
    if (strpos($formasPagoString, '|') !== false) {
        // Múltiples formas de pago
        $partes = explode('|', $formasPagoString);
        foreach ($partes as $parte) {
            if (strpos($parte, ':') !== false) {
                list($forma, $monto) = explode(':', $parte);
                $formas[] = ['forma' => trim($forma), 'monto' => trim($monto)];
            }
        }
    } else if (strpos($formasPagoString, ':') !== false) {
        // Una forma de pago con monto
        list($forma, $monto) = explode(':', $formasPagoString);
        $formas[] = ['forma' => trim($forma), 'monto' => trim($monto)];
    } else {
        // Forma de pago tradicional
        $formas[] = ['forma' => $formasPagoString, 'monto' => $cantidadPago];
    }
    return $formas;
}

$formasPagoActuales = parsearFormasPago($ticket['FormaDePago'], $ticket['CantidadPago']);
?>

<div class="modal fade" id="EdicionFormasPago" tabindex="-1" role="dialog" aria-labelledby="EdicionFormasPagoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#0057b8 !important;color: white;">
        <h5 class="modal-title" id="EdicionFormasPagoLabel">
          <i class="fas fa-credit-card"></i> Editar Formas de Pago - Ticket #<?php echo $folioTicket; ?>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: white;">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <!-- Información del ticket -->
        <div class="row mb-3">
          <div class="col-md-4">
            <div class="card bg-light">
              <div class="card-body p-2">
                <small class="text-muted">Total del Ticket</small><br>
                <strong class="text-primary">$<?php echo number_format($ticket['Total_VentaG'], 2); ?></strong>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card bg-light">
              <div class="card-body p-2">
                <small class="text-muted">Sucursal</small><br>
                <strong><?php echo $ticket['Nombre_Sucursal']; ?></strong>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card bg-light">
              <div class="card-body p-2">
                <small class="text-muted">Vendedor</small><br>
                <strong><?php echo $ticket['AgregadoPor']; ?></strong>
              </div>
            </div>
          </div>
        </div>

        <!-- Forma de pago actual -->
        <div class="alert alert-info">
          <h6><i class="fas fa-info-circle"></i> Forma de Pago Actual:</h6>
          <?php 
          if (count($formasPagoActuales) > 1) {
              echo '<ul class="mb-0">';
              foreach ($formasPagoActuales as $forma) {
                  $monto = $forma['monto'] ? '$' . number_format($forma['monto'], 2) : '';
                  echo "<li><strong>{$forma['forma']}</strong> $monto</li>";
              }
              echo '</ul>';
          } else {
              $forma = $formasPagoActuales[0];
              $monto = $forma['monto'] ? '$' . number_format($forma['monto'], 2) : '';
              echo "<strong>{$forma['forma']}</strong> $monto";
          }
          ?>
        </div>

        <form id="formEdicionPagos">
          <input type="hidden" name="folioTicket" value="<?php echo $folioTicket; ?>">
          <input type="hidden" name="folioSucursal" value="<?php echo $folioSucursal; ?>">
          <input type="hidden" name="totalTicket" value="<?php echo $ticket['Total_VentaG']; ?>">
          
          <!-- Forma de Pago 1 -->
          <div class="form-group">
            <label class="font-weight-bold">Primera Forma de Pago <span class="text-danger">*</span>:</label>
            <div class="row">
              <div class="col-md-6">
                <select name="formaPago1" class="form-control" required>
                  <option value="">Seleccionar forma de pago...</option>
                  <option value="Efectivo" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Efectivo') ? 'selected' : ''; ?>>Efectivo</option>
                  <option value="Tarjeta" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Tarjeta') ? 'selected' : ''; ?>>Tarjeta</option>
                  <option value="Transferencia" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Transferencia') ? 'selected' : ''; ?>>Transferencia</option>
                  <option value="Cheque" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Cheque') ? 'selected' : ''; ?>>Cheque</option>
                  <option value="Credito" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Credito') ? 'selected' : ''; ?>>Crédito</option>
                  <option value="Vale" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Vale') ? 'selected' : ''; ?>>Vale</option>
                </select>
              </div>
              <div class="col-md-6">
                <input type="number" name="montoPago1" class="form-control" 
                       placeholder="Monto" step="0.01" min="0" max="<?php echo $ticket['Total_VentaG']; ?>"
                       value="<?php echo isset($formasPagoActuales[0]) ? $formasPagoActuales[0]['monto'] : ''; ?>" required>
              </div>
            </div>
          </div>

          <!-- Forma de Pago 2 -->
          <div class="form-group">
            <label class="font-weight-bold">Segunda Forma de Pago (Opcional):</label>
            <div class="row">
              <div class="col-md-6">
                <select name="formaPago2" class="form-control">
                  <option value="">Seleccionar forma de pago...</option>
                  <option value="Efectivo" <?php echo (isset($formasPagoActuales[1]) && $formasPagoActuales[1]['forma'] == 'Efectivo') ? 'selected' : ''; ?>>Efectivo</option>
                  <option value="Tarjeta" <?php echo (isset($formasPagoActuales[1]) && $formasPagoActuales[1]['forma'] == 'Tarjeta') ? 'selected' : ''; ?>>Tarjeta</option>
                  <option value="Transferencia" <?php echo (isset($formasPagoActuales[1]) && $formasPagoActuales[1]['forma'] == 'Transferencia') ? 'selected' : ''; ?>>Transferencia</option>
                  <option value="Cheque" <?php echo (isset($formasPagoActuales[1]) && $formasPagoActuales[1]['forma'] == 'Cheque') ? 'selected' : ''; ?>>Cheque</option>
                  <option value="Credito" <?php echo (isset($formasPagoActuales[1]) && $formasPagoActuales[1]['forma'] == 'Credito') ? 'selected' : ''; ?>>Crédito</option>
                  <option value="Vale" <?php echo (isset($formasPagoActuales[1]) && $formasPagoActuales[1]['forma'] == 'Vale') ? 'selected' : ''; ?>>Vale</option>
                </select>
              </div>
              <div class="col-md-6">
                <input type="number" name="montoPago2" class="form-control" 
                       placeholder="Monto" step="0.01" min="0" max="<?php echo $ticket['Total_VentaG']; ?>"
                       value="<?php echo isset($formasPagoActuales[1]) ? $formasPagoActuales[1]['monto'] : ''; ?>">
              </div>
            </div>
          </div>

          <!-- Validación en tiempo real -->
          <div class="alert alert-warning" id="validacionPagos">
            <div class="row">
              <div class="col-md-6">
                <strong>Total Pagado:</strong> $<span id="totalPagado">0.00</span>
              </div>
              <div class="col-md-6">
                <strong>Diferencia:</strong> $<span id="diferencia">0.00</span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="font-weight-bold">Observaciones:</label>
            <textarea name="observaciones" class="form-control" rows="3" 
                      placeholder="Motivo del cambio de forma de pago..."></textarea>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fas fa-times"></i> Cancelar
        </button>
        <button type="button" class="btn btn-success" id="guardarPagos">
          <i class="fas fa-save"></i> Guardar Cambios
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    var totalTicket = parseFloat('<?php echo $ticket['Total_VentaG']; ?>');
    
    // Función para validar en tiempo real
    function validarPagos() {
        var monto1 = parseFloat($('input[name="montoPago1"]').val()) || 0;
        var monto2 = parseFloat($('input[name="montoPago2"]').val()) || 0;
        var totalPagado = monto1 + monto2;
        var diferencia = totalTicket - totalPagado;
        
        $('#totalPagado').text(totalPagado.toFixed(2));
        $('#diferencia').text(diferencia.toFixed(2));
        
        // Cambiar color según la diferencia
        var alertDiv = $('#validacionPagos');
        if (Math.abs(diferencia) < 0.01) {
            alertDiv.removeClass('alert-danger alert-warning').addClass('alert-success');
        } else if (diferencia > 0) {
            alertDiv.removeClass('alert-success alert-danger').addClass('alert-warning');
        } else {
            alertDiv.removeClass('alert-success alert-warning').addClass('alert-danger');
        }
        
        // Habilitar/deshabilitar segundo pago
        if (monto1 >= totalTicket) {
            $('input[name="montoPago2"]').prop('disabled', true).val('');
            $('select[name="formaPago2"]').prop('disabled', true).val('');
        } else {
            $('input[name="montoPago2"]').prop('disabled', false);
            $('select[name="formaPago2"]').prop('disabled', false);
            $('input[name="montoPago2"]').attr('max', totalTicket - monto1);
        }
    }
    
    // Validación en tiempo real
    $('input[name="montoPago1"], input[name="montoPago2"]').on('input', validarPagos);
    $('select[name="formaPago1"], select[name="formaPago2"]').on('change', validarPagos);
    
    // Validación inicial
    validarPagos();

    // Guardar cambios
    $('#guardarPagos').click(function() {
        var monto1 = parseFloat($('input[name="montoPago1"]').val()) || 0;
        var monto2 = parseFloat($('input[name="montoPago2"]').val()) || 0;
        var forma1 = $('select[name="formaPago1"]').val();
        var forma2 = $('select[name="formaPago2"]').val();
        var totalPagado = monto1 + monto2;
        var diferencia = Math.abs(totalTicket - totalPagado);
        
        // Validaciones
        if (!forma1) {
            alert('Debe seleccionar al menos una forma de pago');
            return;
        }
        
        if (monto1 <= 0) {
            alert('El monto del primer pago debe ser mayor a 0');
            return;
        }
        
        if (diferencia > 0.01) {
            alert('El total pagado debe coincidir exactamente con el total del ticket');
            return;
        }
        
        if (forma2 && monto2 <= 0) {
            alert('Si selecciona una segunda forma de pago, debe especificar un monto');
            return;
        }
        
        if (forma1 === forma2) {
            alert('Las formas de pago deben ser diferentes');
            return;
        }
        
        // Mostrar loading
        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Guardando...');
        
        $.ajax({
            url: 'Consultas/ActualizarFormasPagoTicket.php',
            type: 'POST',
            data: $('#formEdicionPagos').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Formas de pago actualizadas correctamente');
                    $('#EdicionFormasPago').modal('hide');
                    // Recargar la página o actualizar la tabla
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('Error de comunicación con el servidor');
            },
            complete: function() {
                $('#guardarPagos').prop('disabled', false).html('<i class="fas fa-save"></i> Guardar Cambios');
            }
        });
    });
});
</script>
