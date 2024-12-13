$('document').ready(function($) {
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
        submitHandler: function() {
            submitForm(); // Llama a la función de envío
        }
    });

    // Manejo del envío del formulario
    function submitForm() {
        const form = $("#RegistroTicketSoporteForm")[0];
        const formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'https://saludapos.com/Tickets/Consultas/RegistroSoporte.php',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#submitTicketSoporte").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
                $("#submitTicketSoporte").prop("disabled", true); // Deshabilitar el botón mientras se envía
            },
            success: function(dataResult) {
                const result = JSON.parse(dataResult);

                if (result.statusCode === 200) {
                    const ticketNumber = result.ticketNumber;

                    $("#submitTicketSoporte").html("Enviado <i class='fas fa-check'></i>");
                    $("#RegistroTicketSoporteForm")[0].reset();

                    // Mostrar mensaje personalizado con el número de ticket
                    const successMessage = `
                        <div class="alert alert-success">
                            <strong>¡Éxito!</strong> Este es tu número de ticket: <strong>${ticketNumber}</strong>.
                            <br>Puedes usar este número para consultar el estado de tu ticket.
                            <br>Haz clic en "Continuar" para recargar la página.
                        </div>
                        <button id="continueBtn" class="btn btn-primary">Continuar</button>
                    `;
                    $('#customMessageContainer').html(successMessage); // Mostrar mensaje en un contenedor específico

                    // Agregar evento para recargar la página al hacer clic en "Continuar"
                    $('#continueBtn').on('click', function() {
                        location.reload();
                    });
                } else {
                    $("#submitTicketSoporte").html("Algo no salió bien... <i class='fas fa-exclamation-triangle'></i>");
                    $('#ErrorData').modal('toggle'); // Muestra modal de error
                    setTimeout(function() {
                        $("#submitTicketSoporte").html("Guardar Ticket <i class='fas fa-check'></i>");
                    }, 3000);
                }
            },
            error: function() {
                $("#submitTicketSoporte").html("Error en la solicitud <i class='fas fa-exclamation-triangle'></i>");
            },
            complete: function() {
                $("#submitTicketSoporte").prop("disabled", false); // Rehabilitar el botón
            }
        });
    }
});
