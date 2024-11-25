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
                            $("#submit_Tickets").html("Enviado <i class='fas fa-check'></i>");
                            $("#RegistroTicketsForm")[0].reset();
                            $("#RegistroTicketsVentanaModal").modal('hide');
                            $('#Exito').modal('toggle');
                            setTimeout(function() {
                                $('#Exito').modal('hide');
                            }, 2000);
                        } else {
                            $("#submit_Tickets").html("Algo no salió bien... <i class='fas fa-exclamation-triangle'></i>");
                            $('#ErrorData').modal('toggle');
                            setTimeout(function() {
                                $("#submit_Tickets").html("Guardar <i class='fas fa-save'></i>");
                            }, 3000);
                        }
                    } catch (e) {
                        console.error("Error al parsear JSON:", dataResult);
                        $("#submit_Tickets").html("Error inesperado <i class='fas fa-exclamation-triangle'></i>");
                    }
                }
                
            });
        });
        return false;
    }
});
