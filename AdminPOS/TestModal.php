<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Test del Modal de Formas de Pago</h2>
        
        <button type="button" class="btn btn-primary" onclick="testModal()">
            Probar Modal
        </button>
        
        <div id="resultado" class="mt-3"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Cancelacionmodal" tabindex="-1" role="dialog" aria-labelledby="CancelacionmodalLabel" aria-hidden="true">
        <div id="Di3" class="modal-dialog modal-xl modal-notify modal-info">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="heading lead" id="TituloCancelacion">Test Modal</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div id="FormCancelacion"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function testModal() {
            // Simular datos de un ticket
            var folioTicket = '1';
            var foliosucursal = 'TEST';
            
            console.log("Iniciando prueba del modal...");
            
            $.post("Modales/EdicionFormasPagoTicket.php", { 
                folioTicket: folioTicket, 
                foliosucursal: foliosucursal 
            }, function(data) {
                console.log("Respuesta del modal:", data);
                $("#FormCancelacion").html(data);
                $("#TituloCancelacion").html("Ajuste de Formas de Pago - Ticket #" + folioTicket);
                $("#Di3").removeClass("modal-dialog modal-lg modal-notify modal-info");
                $("#Di3").addClass("modal-dialog modal-xl modal-notify modal-primary");
                
                $('#Cancelacionmodal').modal('show');
                
                $("#resultado").html('<div class="alert alert-success">Modal cargado exitosamente</div>');
            }).fail(function(xhr, status, error) {
                console.error("Error al cargar el modal:", error);
                console.error("Status:", status);
                console.error("Response:", xhr.responseText);
                
                $("#resultado").html('<div class="alert alert-danger">Error: ' + error + '<br>Status: ' + status + '<br>Response: ' + xhr.responseText + '</div>');
            });
        }
    </script>
</body>
</html>
