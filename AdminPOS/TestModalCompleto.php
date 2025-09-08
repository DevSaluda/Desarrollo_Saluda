<?php
// TestModalCompleto.php - Prueba completa del modal de edición de formas de pago
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Modal Edición Formas de Pago</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Prueba Modal Edición Formas de Pago</h1>
        
        <div class="alert alert-info">
            <h5>Instrucciones:</h5>
            <ol>
                <li>Hacer clic en "Probar Modal"</li>
                <li>Verificar que se carguen los datos del ticket</li>
                <li>Modificar las formas de pago</li>
                <li>Verificar que los cálculos funcionen</li>
                <li>Hacer clic en "Guardar Cambios"</li>
            </ol>
        </div>
        
        <button type="button" class="btn btn-primary" id="probarModal">
            <i class="fas fa-credit-card"></i> Probar Modal
        </button>
        
        <div id="resultado" class="mt-3"></div>
    </div>

    <!-- Modal container -->
    <div id="ModalFormasPagoContainer"></div>

    <script>
    $(document).ready(function() {
        $('#probarModal').on('click', function() {
            // Datos de prueba
            var folioTicket = '0000000919';
            var folioSucursal = 'CAPA';
            
            $.post("Modales/EdicionFormasPagoTicket_Fixed.php", { 
                folioTicket: folioTicket, 
                folioSucursal: folioSucursal 
            }, function(data) {
                console.log("Respuesta del modal:", data);
                $("#ModalFormasPagoContainer").html(data);
                $("#EdicionFormasPago").modal('show');
            }).fail(function(xhr, status, error) {
                console.error("Error al cargar el modal:", error);
                $('#resultado').html('<div class="alert alert-danger">Error al cargar el modal: ' + error + '</div>');
            });
        });
    });
    </script>
</body>
</html>
