$('document').ready(function($) {
    // Variable para controlar si ya se está enviando el formulario
    var isSubmitting = false;

    // Validación del formulario
    $("#RegistroTicketSoporteForm").validate({
        rules: {
            Problematica: {
                required: true,
            },
            DescripcionProblematica: {
                required: true,
            }
        },
        messages: {
            Problematica: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Seleccione un tipo de problema",
            },
            DescripcionProblematica: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Proporcione una descripción de la problemática",
            }
        },
        submitHandler: submitForm
    });
    

    // Manejo del envío del formulario
    function submitForm() {
        $("#RegistroTicketSoporteForm").on('submit', function(e) {
            e.preventDefault(); // Evita el comportamiento predeterminado del formulario

            // Prevenir múltiples envíos
            if (isSubmitting) {
                return false;
            }

            // Marcar como enviando y deshabilitar el botón
            isSubmitting = true;
            var $submitButton = $("#submitTicketSoporte");
            $submitButton.prop('disabled', true);

            // Preparar FormData y agregar fecha y hora local del navegador
const formData = new FormData(this);
const now = new Date();
const fechaHora = now.getFullYear() + '-' +
    String(now.getMonth() + 1).padStart(2, '0') + '-' +
    String(now.getDate()).padStart(2, '0') + ' ' +
    String(now.getHours()).padStart(2, '0') + ':' +
    String(now.getMinutes()).padStart(2, '0') + ':' +
    String(now.getSeconds()).padStart(2, '0');
formData.set('Fecha_Registro', fechaHora);

$.ajax({
    type: 'POST',
    url: 'https://saludapos.com/POS2/Consultas/RegistroSoporte.php',
    data: formData,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $submitButton.html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
                },
                success: function(dataResult) {
                    const result = JSON.parse(dataResult);

                    if (result.statusCode === 200) {
                        $submitButton.html("Enviado <i class='fas fa-check'></i>");
                        $("#RegistroTicketSoporteForm")[0].reset();
                        $("#RegistroTicketSoporteModal").modal('hide'); // Cierra el modal
                        $('#Exito').modal('toggle'); // Muestra modal de éxito
                        setTimeout(function() {
                            $('#Exito').modal('hide');
                            location.reload();
                        }, 2000);
                    } else {
                        // Restaurar el botón en caso de error
                        isSubmitting = false;
                        $submitButton.prop('disabled', false);
                        $submitButton.html("Algo no salió bien... <i class='fas fa-exclamation-triangle'></i>");
                        $('#ErrorData').modal('toggle'); // Muestra modal de error
                        setTimeout(function() {
                            $submitButton.html("Guardar Ticket <i class='fas fa-check'></i>");
                        }, 3000);
                    }
                },
                error: function() {
                    // Restaurar el botón en caso de error
                    isSubmitting = false;
                    $submitButton.prop('disabled', false);
                    $submitButton.html("Error en la solicitud <i class='fas fa-exclamation-triangle'></i>");
                    setTimeout(function() {
                        $submitButton.html("Guardar Ticket <i class='fas fa-check'></i>");
                    }, 3000);
                }
            });
        });
        return false; // Detiene el envío predeterminado
    }

    // Resetear el estado cuando se cierra el modal
    $('#RegistroTicketSoporteModal').on('hidden.bs.modal', function () {
        isSubmitting = false;
        var $submitButton = $("#submitTicketSoporte");
        $submitButton.prop('disabled', false);
        $submitButton.html("Guardar Ticket <i class='fas fa-check'></i>");
    });
    
});
