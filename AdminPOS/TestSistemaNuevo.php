<?php
/**
 * TestSistemaNuevo.php
 * Prueba completa del nuevo sistema de edición de formas de pago
 */
session_start();

// Simular sesión para pruebas
if (!isset($_SESSION['usuario'])) {
    $_SESSION['usuario'] = 'UsuarioPrueba';
    $_SESSION['empresa'] = 'Saluda';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Sistema Nuevo - Edición Formas de Pago</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-4">
                    <i class="fas fa-credit-card text-primary"></i>
                    Prueba Sistema Nuevo - Edición Formas de Pago
                </h1>
                
                <div class="alert alert-info">
                    <h5><i class="fas fa-info-circle"></i> Información de la Prueba</h5>
                    <ul>
                        <li><strong>Sesión:</strong> <?php echo $_SESSION['usuario']; ?> - <?php echo $_SESSION['empresa']; ?></li>
                        <li><strong>Fecha:</strong> <?php echo date('d/m/Y H:i:s'); ?></li>
                        <li><strong>Versión:</strong> Sistema Nuevo Robusto</li>
                    </ul>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5><i class="fas fa-ticket-alt"></i> Prueba con Ticket Real</h5>
                            </div>
                            <div class="card-body">
                                <p>Prueba con datos reales del sistema:</p>
                                <button type="button" class="btn btn-primary btn-block" id="probarTicketReal">
                                    <i class="fas fa-play"></i> Probar con Ticket Real
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5><i class="fas fa-cog"></i> Prueba con Datos Específicos</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="folioTicket">Folio del Ticket:</label>
                                    <input type="text" class="form-control" id="folioTicket" placeholder="Ej: 0000000919">
                                </div>
                                <div class="form-group">
                                    <label for="folioSucursal">Folio Sucursal:</label>
                                    <input type="text" class="form-control" id="folioSucursal" placeholder="Ej: CAPA">
                                </div>
                                <button type="button" class="btn btn-success btn-block" id="probarTicketEspecifico">
                                    <i class="fas fa-search"></i> Probar Ticket Específico
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <div class="card">
                        <div class="card-header bg-warning text-dark">
                            <h5><i class="fas fa-bug"></i> Log de Pruebas</h5>
                        </div>
                        <div class="card-body">
                            <div id="logPruebas" class="bg-light p-3" style="height: 200px; overflow-y: auto;">
                                <p class="text-muted">Los logs de las pruebas aparecerán aquí...</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 text-center">
                    <a href="AjusteTickets.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver al Módulo Principal
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Container -->
    <div id="ModalFormasPagoContainer"></div>

    <script>
    $(document).ready(function() {
        function logMensaje(mensaje, tipo = 'info') {
            const timestamp = new Date().toLocaleTimeString();
            const iconos = {
                'info': 'fas fa-info-circle text-primary',
                'success': 'fas fa-check-circle text-success',
                'error': 'fas fa-exclamation-triangle text-danger',
                'warning': 'fas fa-exclamation-circle text-warning'
            };
            
            const $log = $('#logPruebas');
            const $mensaje = $('<div class="mb-2"></div>');
            $mensaje.html(`<i class="${iconos[tipo]}"></i> [${timestamp}] ${mensaje}`);
            $log.append($mensaje);
            $log.scrollTop($log[0].scrollHeight);
        }
        
        function cargarModal(folioTicket, folioSucursal) {
            logMensaje(`Cargando modal para ticket: ${folioTicket} - ${folioSucursal}`, 'info');
            
            // Mostrar loading
            $("#ModalFormasPagoContainer").html(
                '<div class="modal fade" id="ModalEdicionFormasPago" tabindex="-1">' +
                '<div class="modal-dialog modal-lg">' +
                '<div class="modal-content">' +
                '<div class="modal-body text-center p-4">' +
                '<i class="fas fa-spinner fa-spin fa-2x text-primary"></i><br>' +
                '<p class="mt-2">Cargando información del ticket...</p>' +
                '</div></div></div></div>'
            );
            $("#ModalEdicionFormasPago").modal('show');
            
            $.post("Modales/EdicionFormasPagoTicket_New.php", { 
                folioTicket: folioTicket, 
                folioSucursal: folioSucursal 
            }, function(data) {
                logMensaje('Modal cargado exitosamente', 'success');
                $("#ModalFormasPagoContainer").html(data);
            }).fail(function(xhr, status, error) {
                logMensaje(`Error al cargar modal: ${error}`, 'error');
                console.error("Error:", xhr.responseText);
                
                $("#ModalFormasPagoContainer").html(
                    '<div class="modal fade" id="ModalEdicionFormasPago" tabindex="-1">' +
                    '<div class="modal-dialog modal-lg">' +
                    '<div class="modal-content">' +
                    '<div class="modal-header bg-danger text-white">' +
                    '<h5 class="modal-title">Error al Cargar</h5>' +
                    '<button type="button" class="close text-white" data-dismiss="modal">&times;</button>' +
                    '</div>' +
                    '<div class="modal-body">' +
                    '<div class="alert alert-danger">' +
                    '<h6><i class="fas fa-exclamation-triangle"></i> Error al cargar el modal</h6>' +
                    '<p>No se pudo cargar la información del ticket. Verifica que el ticket existe y tienes permisos.</p>' +
                    '<p><strong>Error:</strong> ' + error + '</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="modal-footer">' +
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>' +
                    '</div>' +
                    '</div></div></div>'
                );
            });
        }
        
        // Prueba con ticket real
        $('#probarTicketReal').on('click', function() {
            logMensaje('Iniciando prueba con ticket real...', 'info');
            cargarModal('0000000919', 'CAPA');
        });
        
        // Prueba con ticket específico
        $('#probarTicketEspecifico').on('click', function() {
            const folioTicket = $('#folioTicket').val().trim();
            const folioSucursal = $('#folioSucursal').val().trim();
            
            if (!folioTicket || !folioSucursal) {
                logMensaje('Por favor, ingresa el folio del ticket y la sucursal', 'warning');
                return;
            }
            
            logMensaje(`Iniciando prueba con ticket específico: ${folioTicket} - ${folioSucursal}`, 'info');
            cargarModal(folioTicket, folioSucursal);
        });
        
        // Log inicial
        logMensaje('Sistema de pruebas inicializado correctamente', 'success');
    });
    </script>
</body>
</html>
