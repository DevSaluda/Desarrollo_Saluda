<?php
/**
 * EdicionFormasPagoTicket_New.php
 * Sistema robusto para edición de formas de pago
 * Manejo seguro de IDs y datos sensibles
 */

// Configuración de seguridad
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Validar sesión activa
session_start();
if (!isset($_SESSION['usuario']) || !isset($_SESSION['empresa'])) {
    echo '<div class="alert alert-danger">Error: Sesión no válida</div>';
    exit;
}

// Validar datos de entrada
$folioTicket = isset($_POST["folioTicket"]) ? trim($_POST["folioTicket"]) : '';
$folioSucursal = isset($_POST["folioSucursal"]) ? trim($_POST["folioSucursal"]) : '';

if (empty($folioTicket) || empty($folioSucursal)) {
    echo '<div class="alert alert-danger">Error: Datos del ticket no proporcionados</div>';
    exit;
}

// Validar formato de folio (solo números y letras)
if (!preg_match('/^[A-Z0-9]+$/', $folioTicket) || !preg_match('/^[A-Z0-9]+$/', $folioSucursal)) {
    echo '<div class="alert alert-danger">Error: Formato de folio inválido</div>';
    exit;
}

// Incluir conexión a base de datos
$adminPosPath = dirname(__DIR__);
include $adminPosPath . "/Consultas/db_connection.php";

if (!$conn) {
    echo '<div class="alert alert-danger">Error: No hay conexión a la base de datos</div>';
    exit;
}

// Consulta segura con prepared statements
$sql = "SELECT v.*, s.Nombre_Sucursal 
        FROM Ventas_POS v
        INNER JOIN SucursalesCorre s ON v.Fk_sucursal = s.ID_SucursalC
        WHERE v.Folio_Ticket = ? AND v.FolioSucursal = ?
        LIMIT 1";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo '<div class="alert alert-danger">Error: No se pudo preparar la consulta</div>';
    exit;
}

$stmt->bind_param("ss", $folioTicket, $folioSucursal);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo '<div class="alert alert-danger">Error: Ticket no encontrado</div>';
    $stmt->close();
    exit;
}

$ticket = $result->fetch_assoc();
$stmt->close();

// Función para parsear formas de pago de forma segura
function parsearFormasPagoSeguro($formasPagoString, $cantidadPago = 0) {
    $formas = [];
    
    if (empty($formasPagoString)) {
        return $formas;
    }
    
    // Verificar si tiene múltiples formas de pago
    if (strpos($formasPagoString, '|') !== false) {
        $partes = explode('|', $formasPagoString);
        foreach ($partes as $parte) {
            if (strpos($parte, ':') !== false) {
                $datos = explode(':', $parte, 2);
                if (count($datos) == 2) {
                    $formas[] = [
                        'forma' => trim($datos[0]),
                        'monto' => floatval(trim($datos[1]))
                    ];
                }
            }
        }
    } else if (strpos($formasPagoString, ':') !== false) {
        // Una forma de pago con monto
        $datos = explode(':', $formasPagoString, 2);
        if (count($datos) == 2) {
            $formas[] = [
                'forma' => trim($datos[0]),
                'monto' => floatval(trim($datos[1]))
            ];
        }
    } else {
        // Forma de pago tradicional
        $formas[] = [
            'forma' => trim($formasPagoString),
            'monto' => floatval($cantidadPago)
        ];
    }
    
    return $formas;
}

$formasPagoActuales = parsearFormasPagoSeguro($ticket['FormaDePago'], $ticket['CantidadPago']);

// Generar token de seguridad para el formulario
$tokenSeguridad = bin2hex(random_bytes(16));
$_SESSION['token_formas_pago'] = $tokenSeguridad;
?>

<!-- Modal de Edición de Formas de Pago -->
<div class="modal fade" id="ModalEdicionFormasPago" tabindex="-1" role="dialog" aria-labelledby="ModalEdicionFormasPagoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ModalEdicionFormasPagoLabel">
                    <i class="fas fa-credit-card"></i> 
                    Editar Formas de Pago - Ticket #<?php echo htmlspecialchars($folioTicket); ?>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <!-- Información del ticket -->
                <div class="alert alert-info">
                    <h6><i class="fas fa-info-circle"></i> Información del Ticket</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Folio:</strong> <?php echo htmlspecialchars($folioTicket); ?></p>
                            <p><strong>Sucursal:</strong> <?php echo htmlspecialchars($ticket['Nombre_Sucursal']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Total:</strong> $<?php echo number_format($ticket['Total_VentaG'], 2); ?></p>
                            <p><strong>Fecha:</strong> <?php echo date('d/m/Y H:i', strtotime($ticket['Fecha_venta'])); ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Formulario de edición -->
                <form id="formEdicionFormasPago" novalidate>
                    <input type="hidden" name="folioTicket" value="<?php echo htmlspecialchars($folioTicket); ?>">
                    <input type="hidden" name="folioSucursal" value="<?php echo htmlspecialchars($folioSucursal); ?>">
                    <input type="hidden" name="tokenSeguridad" value="<?php echo $tokenSeguridad; ?>">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formaPago1" class="font-weight-bold">Forma de Pago 1 *</label>
                                <select class="form-control" name="formaPago1" id="formaPago1" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Efectivo" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Efectivo') ? 'selected' : ''; ?>>Efectivo</option>
                                    <option value="Tarjeta" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Tarjeta') ? 'selected' : ''; ?>>Tarjeta</option>
                                    <option value="Transferencia" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Transferencia') ? 'selected' : ''; ?>>Transferencia</option>
                                    <option value="Cheque" <?php echo (isset($formasPagoActuales[0]) && $formasPagoActuales[0]['forma'] == 'Cheque') ? 'selected' : ''; ?>>Cheque</option>
                                </select>
                                <div class="invalid-feedback">Selecciona una forma de pago</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="montoPago1" class="font-weight-bold">Monto 1 *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" name="montoPago1" id="montoPago1" 
                                           value="<?php echo isset($formasPagoActuales[0]) ? number_format($formasPagoActuales[0]['monto'], 2) : '0.00'; ?>" 
                                           step="0.01" min="0" max="<?php echo $ticket['Total_VentaG']; ?>" required>
                                    <div class="invalid-feedback">Ingresa un monto válido</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formaPago2" class="font-weight-bold">Forma de Pago 2 (Opcional)</label>
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
                                <label for="montoPago2" class="font-weight-bold">Monto 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" name="montoPago2" id="montoPago2" 
                                           value="<?php echo isset($formasPagoActuales[1]) ? number_format($formasPagoActuales[1]['monto'], 2) : ''; ?>" 
                                           step="0.01" min="0" max="<?php echo $ticket['Total_VentaG']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="observaciones" class="font-weight-bold">Observaciones</label>
                        <textarea class="form-control" name="observaciones" id="observaciones" rows="3" 
                                  placeholder="Observaciones sobre el cambio de formas de pago (opcional)..." 
                                  maxlength="500"></textarea>
                        <small class="form-text text-muted">Máximo 500 caracteres</small>
                    </div>
                    
                    <!-- Resumen de validación -->
                    <div class="alert alert-warning" id="resumenValidacion">
                        <h6><i class="fas fa-calculator"></i> Resumen de Pagos</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Total del Ticket:</strong><br>$<span id="totalTicket"><?php echo number_format($ticket['Total_VentaG'], 2); ?></span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Total Pagado:</strong><br>$<span id="totalPagado">0.00</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Diferencia:</strong><br>$<span id="diferencia" class="font-weight-bold">0.00</span></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button type="button" class="btn btn-success" id="btnGuardarFormasPago">
                    <i class="fas fa-save"></i> Guardar Cambios
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    const totalTicket = parseFloat('<?php echo $ticket['Total_VentaG']; ?>');
    let isValid = false;
    
    // Función para calcular totales y validar
    function calcularYValidar() {
        const monto1 = parseFloat($('#montoPago1').val()) || 0;
        const monto2 = parseFloat($('#montoPago2').val()) || 0;
        const formaPago2 = $('#formaPago2').val();
        
        const totalPagado = monto1 + monto2;
        const diferencia = Math.abs(totalPagado - totalTicket);
        
        // Actualizar resumen
        $('#totalPagado').text(totalPagado.toFixed(2));
        $('#diferencia').text(diferencia.toFixed(2));
        
        // Validar que las formas de pago sean diferentes si hay dos
        const formaPago1 = $('#formaPago1').val();
        const formasDiferentes = !formaPago2 || formaPago1 !== formaPago2;
        
        // Validar que la suma coincida exactamente
        const sumaCorrecta = diferencia < 0.01;
        
        // Validar que haya al menos una forma de pago
        const tieneFormaPago = formaPago1 && monto1 > 0;
        
        // Validar que si hay segunda forma de pago, tenga monto
        const segundaFormaValida = !formaPago2 || monto2 > 0;
        
        isValid = formasDiferentes && sumaCorrecta && tieneFormaPago && segundaFormaValida;
        
        // Aplicar estilos según validación
        const $diferencia = $('#diferencia');
        $diferencia.removeClass('text-success text-danger text-warning');
        
        if (sumaCorrecta) {
            $diferencia.addClass('text-success');
        } else if (totalPagado > totalTicket) {
            $diferencia.addClass('text-danger');
        } else {
            $diferencia.addClass('text-warning');
        }
        
        // Habilitar/deshabilitar botón de guardar
        $('#btnGuardarFormasPago').prop('disabled', !isValid);
        
        // Mostrar mensajes de validación
        if (!formasDiferentes && formaPago2) {
            mostrarError('Las formas de pago deben ser diferentes');
        } else if (!sumaCorrecta) {
            mostrarError('La suma de los pagos debe coincidir exactamente con el total del ticket');
        } else if (!tieneFormaPago) {
            mostrarError('Debe seleccionar al menos una forma de pago con monto');
        } else if (!segundaFormaValida) {
            mostrarError('Si selecciona una segunda forma de pago, debe ingresar un monto');
        } else {
            ocultarError();
        }
    }
    
    function mostrarError(mensaje) {
        let $errorDiv = $('#mensajeError');
        if ($errorDiv.length === 0) {
            $errorDiv = $('<div id="mensajeError" class="alert alert-danger mt-2"></div>');
            $('#resumenValidacion').after($errorDiv);
        }
        $errorDiv.html('<i class="fas fa-exclamation-triangle"></i> ' + mensaje);
    }
    
    function ocultarError() {
        $('#mensajeError').remove();
    }
    
    // Eventos para cálculo en tiempo real
    $('#montoPago1, #montoPago2, #formaPago1, #formaPago2').on('input change', calcularYValidar);
    
    // Validación de formulario
    $('#formEdicionFormasPago').on('submit', function(e) {
        e.preventDefault();
        if (!isValid) {
            mostrarError('Por favor, corrige los errores antes de guardar');
            return false;
        }
        return true;
    });
    
    // Guardar cambios
    $('#btnGuardarFormasPago').on('click', function() {
        if (!isValid) {
            mostrarError('Por favor, corrige los errores antes de guardar');
            return;
        }
        
        const formData = $('#formEdicionFormasPago').serialize();
        const $btn = $(this);
        const originalText = $btn.html();
        
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Guardando...');
        
        $.ajax({
            url: 'Consultas/ActualizarFormasPagoTicket_New.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Mostrar mensaje de éxito
                    const $successDiv = $('<div class="alert alert-success mt-2"></div>');
                    $successDiv.html('<i class="fas fa-check-circle"></i> ' + response.message);
                    $('#resumenValidacion').after($successDiv);
                    
                    // Cerrar modal después de 1.5 segundos
                    setTimeout(function() {
                        $('#ModalEdicionFormasPago').modal('hide');
                        // Recargar tabla si existe la función
                        if (typeof CargaAjusteTickets === 'function') {
                            CargaAjusteTickets();
                        }
                    }, 1500);
                } else {
                    mostrarError(response.message || 'Error al guardar los cambios');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error AJAX:', error);
                mostrarError('Error de conexión al guardar los cambios');
            },
            complete: function() {
                $btn.prop('disabled', false).html(originalText);
            }
        });
    });
    
    // Calcular totales iniciales
    calcularYValidar();
});
</script>
