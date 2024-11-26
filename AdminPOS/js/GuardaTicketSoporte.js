$('document').ready(function($) {
    $("#RegistroTicketsForm").validate({
        rules: {
            tipoProblema: {
                required: true,
            },
            DescripcionProblematica: {
                required: true,
            }
        },
        messages: {
            tipoProblema: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Seleccione un tipo de problema",
            },
            DescripcionProblematica: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Proporcione una descripción de la problemática",
            }
        },
        submitHandler: submitForm
    });

    function submitForm() {
        $("#RegistroTicketsForm").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'https://saludapos.com/AdminPOS/Consultas/RegistroSoporte.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#submitTicketSoporte").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
                },
                success: function(dataResult) {
                    try {
                        const result = JSON.parse(dataResult);

                        if (result.statusCode === 200) {
                            $("#submitTicketSoporte").html("Enviado <i class='fas fa-check'></i>");
                            $("#RegistroTicketsForm")[0].reset();
                            $("#RegistroTicketSoporteModal").modal('hide');
                            $('#Exito').modal('toggle');
                            setTimeout(function() {
                                $('#Exito').modal('hide');
                            }, 2000);
                        } else {
                            const errorMessage = result.message || "Algo no salió bien...";
                            $("#submitTicketSoporte").html(`${errorMessage} <i class='fas fa-exclamation-triangle'></i>`);
                            $('#ErrorData').modal('toggle');
                            setTimeout(function() {
                                $("#submitTicketSoporte").html("Guardar <i class='fas fa-save'></i>");
                            }, 3000);
                        }
                    } catch (e) {
                        console.error("Error al parsear JSON:", dataResult, e);
                        $("#submitTicketSoporte").html("Error inesperado <i class='fas fa-exclamation-triangle'></i>");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", status, error);
                    $("#submitTicketSoporte").html("Error en la conexión <i class='fas fa-exclamation-triangle'></i>");
                }
            });
        });
        return false;
    }
});
