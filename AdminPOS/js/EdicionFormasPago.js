/**
 * JavaScript para la edición de formas de pago
 * Desarrollo_Saluda/AdminPOS/js/EdicionFormasPago.js
 */

$(document).ready(function() {
    
    // Función para validar formas de pago en tiempo real
    function validarFormasPago() {
        var totalTicket = parseFloat($('input[name="totalTicket"]').val()) || 0;
        var monto1 = parseFloat($('input[name="montoPago1"]').val()) || 0;
        var monto2 = parseFloat($('input[name="montoPago2"]').val()) || 0;
        var forma1 = $('select[name="formaPago1"]').val();
        var forma2 = $('select[name="formaPago2"]').val();
        
        var totalPagado = monto1 + monto2;
        var diferencia = totalTicket - totalPagado;
        
        // Actualizar display
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
        
        // Validar que las formas de pago sean diferentes
        if (forma1 && forma2 && forma1 === forma2) {
            $('select[name="formaPago2"]').addClass('is-invalid');
            $('#errorFormasIguales').remove();
            $('select[name="formaPago2"]').after('<div id="errorFormasIguales" class="invalid-feedback">Las formas de pago deben ser diferentes</div>');
        } else {
            $('select[name="formaPago2"]').removeClass('is-invalid');
            $('#errorFormasIguales').remove();
        }
    }
    
    // Event listeners para validación en tiempo real
    $('input[name="montoPago1"], input[name="montoPago2"]').on('input', validarFormasPago);
    $('select[name="formaPago1"], select[name="formaPago2"]').on('change', validarFormasPago);
    
    // Validación inicial
    validarFormasPago();

    // Función para guardar cambios
    $('#guardarPagos').click(function() {
        var monto1 = parseFloat($('input[name="montoPago1"]').val()) || 0;
        var monto2 = parseFloat($('input[name="montoPago2"]').val()) || 0;
        var forma1 = $('select[name="formaPago1"]').val();
        var forma2 = $('select[name="formaPago2"]').val();
        var totalTicket = parseFloat($('input[name="totalTicket"]').val()) || 0;
        var totalPagado = monto1 + monto2;
        var diferencia = Math.abs(totalTicket - totalPagado);
        
        // Validaciones
        if (!forma1) {
            mostrarError('Debe seleccionar al menos una forma de pago');
            return;
        }
        
        if (monto1 <= 0) {
            mostrarError('El monto del primer pago debe ser mayor a 0');
            return;
        }
        
        if (diferencia > 0.01) {
            mostrarError('El total pagado debe coincidir exactamente con el total del ticket');
            return;
        }
        
        if (forma2 && monto2 <= 0) {
            mostrarError('Si selecciona una segunda forma de pago, debe especificar un monto');
            return;
        }
        
        if (forma1 === forma2) {
            mostrarError('Las formas de pago deben ser diferentes');
            return;
        }
        
        // Mostrar loading
        var $btn = $(this);
        var originalText = $btn.html();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Guardando...');
        
        // Enviar datos
        $.ajax({
            url: 'Consultas/ActualizarFormasPagoTicket.php',
            type: 'POST',
            data: $('#formEdicionPagos').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    mostrarExito('Formas de pago actualizadas correctamente');
                    setTimeout(function() {
                        $('#EdicionFormasPago').modal('hide');
                        location.reload();
                    }, 1500);
                } else {
                    mostrarError('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error AJAX:', error);
                mostrarError('Error de comunicación con el servidor');
            },
            complete: function() {
                $btn.prop('disabled', false).html(originalText);
            }
        });
    });
    
    // Función para mostrar errores
    function mostrarError(mensaje) {
        // Remover alertas anteriores
        $('.alert-temp').remove();
        
        // Crear nueva alerta
        var alerta = '<div class="alert alert-danger alert-temp alert-dismissible fade show" role="alert">' +
                    '<i class="fas fa-exclamation-triangle"></i> ' + mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>';
        
        // Insertar al inicio del modal body
        $('#EdicionFormasPago .modal-body').prepend(alerta);
        
        // Auto-remover después de 5 segundos
        setTimeout(function() {
            $('.alert-temp').fadeOut();
        }, 5000);
    }
    
    // Función para mostrar éxito
    function mostrarExito(mensaje) {
        // Remover alertas anteriores
        $('.alert-temp').remove();
        
        // Crear nueva alerta
        var alerta = '<div class="alert alert-success alert-temp alert-dismissible fade show" role="alert">' +
                    '<i class="fas fa-check-circle"></i> ' + mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>';
        
        // Insertar al inicio del modal body
        $('#EdicionFormasPago .modal-body').prepend(alerta);
    }
    
    // Función para cargar formas de pago
    window.cargarFormasPago = function(folioTicket, folioSucursal) {
        // Cargar el modal con los datos del ticket
        $.ajax({
            url: 'Modales/EdicionFormasPagoTicket.php',
            type: 'POST',
            data: {
                folioTicket: folioTicket,
                foliosucursal: folioSucursal
            },
            success: function(response) {
                // Reemplazar el contenido del modal
                $('#EdicionFormasPago').html(response);
                $('#EdicionFormasPago').modal('show');
            },
            error: function() {
                alert('Error al cargar el modal de formas de pago');
            }
        });
    };
    
    // Limpiar formulario al cerrar el modal
    $('#EdicionFormasPago').on('hidden.bs.modal', function() {
        $('.alert-temp').remove();
        $('#formEdicionPagos')[0].reset();
    });
    
    // Validar formato de números
    $('input[type="number"]').on('input', function() {
        var value = $(this).val();
        if (value && (isNaN(value) || parseFloat(value) < 0)) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
    
    // Auto-completar segundo pago si solo queda una opción
    $('input[name="montoPago1"]').on('input', function() {
        var monto1 = parseFloat($(this).val()) || 0;
        var totalTicket = parseFloat($('input[name="totalTicket"]').val()) || 0;
        var monto2 = totalTicket - monto1;
        
        if (monto2 > 0 && monto2 < totalTicket) {
            $('input[name="montoPago2"]').val(monto2.toFixed(2));
        }
    });
});
