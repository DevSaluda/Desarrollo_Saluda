<?php
// Desarrollo_Saluda/AdminPOS/Modales/EdicionFormasPagoTicket_Fixed.php
// Versión con rutas absolutas para evitar problemas de rutas

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Obtener datos del ticket
$folioTicket = isset($_POST["folioTicket"]) ? $_POST["folioTicket"] : '';
$folioSucursal = isset($_POST["foliosucursal"]) ? $_POST["foliosucursal"] : '';

if (empty($folioTicket) || empty($folioSucursal)) {
    echo '<div class="alert alert-danger">Error: No se proporcionaron los datos del ticket</div>';
    exit;
}

// Obtener la ruta absoluta del directorio AdminPOS
$adminPosPath = dirname(__DIR__);

// Incluir la conexión a la base de datos usando ruta absoluta
include $adminPosPath . "/Consultas/db_connection.php";

if (!$conn) {
    echo '<div class="alert alert-danger">Error: No hay conexión a la base de datos</div>';
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

if (!$result) {
    echo '<div class="alert alert-danger">Error en la consulta: ' . $conn->error . '</div>';
    exit;
}

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
        <div class="alert alert-info">
          <h6><i class="fas fa-info-circle"></i> Información del Ticket</h6>
          <p><strong>Folio:</strong> <?php echo $folioTicket; ?></p>
          <p><strong>Sucursal:</strong> <?php echo $ticket['Nombre_Sucursal']; ?></p>
          <p><strong>Total:</strong> $<?php echo number_format($ticket['Total_VentaG'], 2); ?></p>
          <p><strong>Forma de Pago Actual:</strong> <?php echo $ticket['FormaDePago']; ?></p>
        </div>
        
        <!-- Formulario de edición -->
        <form id="formEdicionFormasPago">
          <input type="hidden" name="folioTicket" value="<?php echo $folioTicket; ?>">
          <input type="hidden" name="folioSucursal" value="<?php echo $folioSucursal; ?>">
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="formaPago1">Forma de Pago 1</label>
                <select class="form-control" name="formaPago1" id="formaPago1" required>
                  <option value="">Seleccionar...</option>
                  <option value="Efectivo" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Efectivo') ? 'selected' : ''; ?>>Efectivo</option>
                  <option value="Tarjeta" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Tarjeta') ? 'selected' : ''; ?>>Tarjeta</option>
                  <option value="Transferencia" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Transferencia') ? 'selected' : ''; ?>>Transferencia</option>
                  <option value="Cheque" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Cheque') ? 'selected' : ''; ?>>Cheque</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="montoPago1">Monto 1</label>
                <input type="number" class="form-control" name="montoPago1" id="montoPago1" 
                       value="<?php echo isset($formasPagoActuales[0]) ? $formasPagoActuales[0]['monto'] : ''; ?>" 
                       step="0.01" min="0" required>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="formaPago2">Forma de Pago 2 (Opcional)</label>
                <select class="form-control" name="formaPago2" id="formaPago2">
                  <option value="">Ninguna</option>
                  <option value="Efectivo" <?php echo (isset($formasPagoActuales[1]) && $formasPagoActuales[1]['forma'] == 'Efectivo') ? 'selected' : ''; ?>>Efectivo</option>
                  <option value="Tarjeta" <?php echo (isset($formasPagoActuales[1]) && $formasPagoActuales[1]['forma'] == 'Tarjeta') ? 'selected' : ''; ?>>Tarjeta</option>
                  <option value="Transferencia" <?php echo (isset($formasPagoActuales[1]) && $formasPagoActuales[1]['forma'] == 'Transferencia') ? 'selected' : ''; ?>>Transferencia</option>
                  <option value="Cheque" <?php echo (isset($formasPagoActuales[1]) && $formasPagoActuales[1]['forma'] == 'Cheque') ? 'selected' : ''; ?>>Cheque</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="montoPago2">Monto 2</label>
                <input type="number" class="form-control" name="montoPago2" id="montoPago2" 
                       value="<?php echo isset($formasPagoActuales[1]) ? $formasPagoActuales[1]['monto'] : ''; ?>" 
                       step="0.01" min="0">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea class="form-control" name="observaciones" id="observaciones" rows="3" 
                      placeholder="Observaciones sobre el cambio de formas de pago..."></textarea>
          </div>
          
          <div class="alert alert-warning">
            <h6><i class="fas fa-exclamation-triangle"></i> Resumen</h6>
            <p><strong>Total del Ticket:</strong> $<span id="totalTicket"><?php echo number_format($ticket['Total_VentaG'], 2); ?></span></p>
            <p><strong>Total Pagado:</strong> $<span id="totalPagado">0.00</span></p>
            <p><strong>Diferencia:</strong> $<span id="diferencia">0.00</span></p>
          </div>
        </form>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="guardarPagos">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    // Calcular totales en tiempo real
    function calcularTotales() {
        var monto1 = parseFloat($('#montoPago1').val()) || 0;
        var monto2 = parseFloat($('#montoPago2').val()) || 0;
        var totalPagado = monto1 + monto2;
        var totalTicket = parseFloat('<?php echo $ticket['Total_VentaG']; ?>');
        var diferencia = totalPagado - totalTicket;
        
        $('#totalPagado').text(totalPagado.toFixed(2));
        $('#diferencia').text(diferencia.toFixed(2));
        
        if (Math.abs(diferencia) < 0.01) {
            $('#diferencia').removeClass('text-danger text-warning').addClass('text-success');
        } else if (diferencia > 0) {
            $('#diferencia').removeClass('text-success text-warning').addClass('text-danger');
        } else {
            $('#diferencia').removeClass('text-success text-danger').addClass('text-warning');
        }
    }
    
    $('#montoPago1, #montoPago2').on('input', calcularTotales);
    
    // Calcular totales iniciales
    calcularTotales();
    
    // Guardar cambios
    $('#guardarPagos').on('click', function() {
        var formData = $('#formEdicionFormasPago').serialize();
        
        $.ajax({
            url: '../Consultas/ActualizarFormasPagoTicket_Simple.php',
            type: 'POST',
            data: formData,
            beforeSend: function() {
                $('#guardarPagos').html('<i class="fas fa-spinner fa-spin"></i> Guardando...');
            },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.success) {
                    alert('Formas de pago actualizadas correctamente');
                    $('#EdicionFormasPago').modal('hide');
                    // Recargar la tabla
                    if (typeof CargaAjusteTickets === 'function') {
                        CargaAjusteTickets();
                    }
                } else {
                    alert('Error: ' + result.message);
                }
            },
            error: function() {
                alert('Error al guardar los cambios');
            },
            complete: function() {
                $('#guardarPagos').html('Guardar Cambios');
            }
        });
    });
});
</script>
