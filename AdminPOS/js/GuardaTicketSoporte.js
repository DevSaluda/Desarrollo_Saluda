$('document').ready(function($) {
    $("#RegistroTicketSoporteModal").validate({
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
        $("#RegistroTicketSoporteModal").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'https://saludapos.com/AdminPOS/Consultas/RegistroSoporte.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#submit_Mantenimiento").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
                },
                success: function(dataResult) {
                    const result = JSON.parse(dataResult);

                    if (result.statusCode === 200) {
                        $("#submit_Mantenimiento").html("Enviado <i class='fas fa-check'></i>");
                        $("#RegistroTicketSoporteModal")[0].reset();
                        $("#RegistroMantenimientoVentanaModal").modal('hide');
                        $('#Exito').modal('toggle');
                        setTimeout(function() {
                            $('#Exito').modal('hide');
                        }, 2000);
                    } else {
                        $("#submit_Mantenimiento").html("Algo no salió bien... <i class='fas fa-exclamation-triangle'></i>");
                        $('#ErrorData').modal('toggle');
                        setTimeout(function() {
                            $("#submit_Mantenimiento").html("Guardar <i class='fas fa-save'></i>");
                        }, 3000);
                    }
                }
            });
        });
        return false;
    }
});
