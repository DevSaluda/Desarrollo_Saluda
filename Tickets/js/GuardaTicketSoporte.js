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
        submitHandler: submitForm // Llama a la función submitForm cuando el formulario es válido
    });

    // Manejo del envío del formulario
    function submitForm() {
        // Obtener los datos del formulario
        var formData = $('#RegistroTicketSoporteForm').serializeArray();
        var formValues = {};
        $(formData).each(function(index, obj) {
            formValues[obj.name] = obj.value;
        });

        // Construir el mensaje de confirmación con los datos del formulario
        var alertMessage = "<p>Confirmar los siguientes datos:</p><br>";
        alertMessage += "<p>Problema: " + formValues['Problematica'] + "</p><br>";
        alertMessage += "<p>Descripción: " + formValues['DescripcionProblematica'] + "</p><br>";

        // Mostrar la alerta de Sweet Alert
        Swal.fire({
            title: "Confirmar datos",
            html: alertMessage,
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, enviar los datos al servidor
                $.ajax({
                    type: 'POST',
                    url: 'https://saludapos.com/Tickets/Consultas/RegistroSoporte.php',
                    data: new FormData($('#RegistroTicketSoporteForm')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#submitTicketSoporte").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
                    },
                    success: function(dataResult) {
                        const result = JSON.parse(dataResult);

                        if (result.statusCode === 200) {
                            $("#submitTicketSoporte").html("Enviado <i class='fas fa-check'></i>");
                            $("#RegistroTicketSoporteForm")[0].reset();
                            $("#RegistroTicketSoporteModal").modal('hide'); // Cierra el modal
                            $('#Exito').modal('toggle'); // Muestra modal de éxito
                            setTimeout(function() {
                                $('#Exito').modal('hide');
                            }, 2000);
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
                    }
                });
            }
        });

        // Retornar false para evitar el envío del formulario tradicional
        return false;
    }
});
