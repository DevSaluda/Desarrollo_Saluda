$('document').ready(function($) {

    $("#AgendaLaboratorios").validate({
        rules: {
            Nombres: {
                required: true,
            },
            Tel: {
                required: true,
            },
            Fecha: {
                required: true,
            },
            Enfermero: {
                required: true,
            },
            Indicaciones: {
                required: true
            },

        },
        messages: {
            Nombres: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },

            Tel: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
            Fecha: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
            Enfermero: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
            Indicaciones: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
        },
        submitHandler: submitForm
    });
    function submitForm() {

        $.ajax({
            type: 'POST',
            url: "https://controlconsulta.com/Enfermeria2/Consultas/GuardarAgendaLaboratorio.php",
            data: $('#AgendaLaboratorios').serialize(),
            cache: false,
            beforeSend: function() {


                $("#submit_Lab").html("Un momento... <i class='fas fa-check'></i>");


            },
            success: function(dataResult) {

                var dataResult = JSON.parse(dataResult);

                if (dataResult.statusCode == 250) {
                    var modal_lv = 0;
                    $('.modal').on('shown.bs.modal', function(e) {
                        $('.modal-backdrop:last').css('zIndex', 1051 + modal_lv);
                        $(e.currentTarget).css('zIndex', 1052 + modal_lv);
                        modal_lv++
                    });

                    $('.modal').on('hidden.bs.modal', function(e) {
                        modal_lv--
                    });
                    $("#submit_Lab").html("Algo no salio bien.. <i class='fas fa-exclamation-triangle'></i>");
                    $('#ErrorDupli').modal('toggle');
                    setTimeout(function() {}, 2000); // abrir
                    setTimeout(function() {
                        $("#submit_Lab").html("Guardar <i class='fas fa-save'></i>");
                    }, 3000); // abrir


                } else if (dataResult.statusCode == 200) {


                    $("#submit_Lab").html("Completo <i class='fas fa-check'></i>");
                    $("#CitaExt").removeClass("in");
                    $(".modal-backdrop").remove();
                    $("#CitaExt").hide();
                    $('#Exito').modal('toggle');
                    $("#AgendaLaboratorios")[0].reset();

                    setTimeout(function() {
                        $('#Exito').modal('hide')
                    }, 2000); // abrir

                    $("#submit_Lab").html("Guardar <i class='fas fa-save'></i>");
                } else if (dataResult.statusCode == 201) {
                    var modal_lv = 0;
                    $('.modal').on('shown.bs.modal', function(e) {
                        $('.modal-backdrop:last').css('zIndex', 1051 + modal_lv);
                        $(e.currentTarget).css('zIndex', 1052 + modal_lv);
                        modal_lv++
                    });

                    $('.modal').on('hidden.bs.modal', function(e) {
                        modal_lv--
                    });
                    $("#submit_Lab").html("Algo no salio bien.. <i class='fas fa-exclamation-triangle'></i>");
                    $('#ErrorData').modal('toggle');
                    setTimeout(function() {}, 2000); // abrir
                    setTimeout(function() {
                        $("#submit_Lab").html("Guardar <i class='fas fa-save'></i>");
                    }, 3000); // abrir

                }







            }
        });
        return false;
    }
});