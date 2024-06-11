$('document').ready(function ($) {
    $.validator.addMethod("Sololetras", function (value, element) {
        return this.optional(element) || /[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
    $.validator.addMethod("Telefonico", function (value, element) {
        return this.optional(element) || /^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar números!");
    $.validator.addMethod("Correos", function (value, element) {
        return this.optional(element) || /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Ingresa un correo válido!");
    $.validator.addMethod("NEmpresa", function (value, element) {
        return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
    $.validator.addMethod("Problema", function (value, element) {
        return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");

    $("#AgregaTipoConsultaNueva").validate({
        rules: {
            NombreTipoConsulta: {
                required: true,
            },
            VigenciaTipoConsulta: {
                required: true,
            },
        },
        messages: {
            NombreTipoConsulta: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
            VigenciaTipoConsulta: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
        },
        submitHandler: submitForm
    });

    function submitForm() {
        $.ajax({
            type: 'POST',
            url: "Consultas/AgregaTipoConsultaNueva.php",
            data: $('#AgregaTipoConsultaNueva').serialize(),
            cache: false,
            beforeSend: function () {
                $("#submit_registro").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
            },
            success: function (dataResult) {
                var dataResult = JSON.parse(dataResult);

                if (dataResult.statusCode == 250) {
                    var modal_lv = 0;
                    $('.modal').on('shown.bs.modal', function (e) {
                        $('.modal-backdrop:last').css('zIndex', 1051 + modal_lv);
                        $(e.currentTarget).css('zIndex', 1052 + modal_lv);
                        modal_lv++
                    });
                    $('.modal').on('hidden.bs.modal', function (e) {
                        modal_lv--
                    });
                    $("#submit_registro").html("Algo no salió bien... <i class='fas fa-exclamation-triangle'></i>");
                    $('#ErrorDupli').modal('toggle');
                    setTimeout(function () {
                    }, 2000); // abrir
                    setTimeout(function () {
                        $("#submit_registro").html("Guardar <i class='fas fa-save'></i>");
                    }, 3000); // abrir
                } else if (dataResult.statusCode == 200) {
                    $("#submit_registro").html("Enviado <i class='fas fa-check'></i>")
                    $("#AgregaTipoConsultaNueva")[0].reset();
                    $("#AltadeTiposConsultas").removeClass("in");
                    $(".modal-backdrop").remove();
                    $("#AltadeTiposConsultas").hide();
                    $('#Exito').modal('toggle');
                    setTimeout(function () {
                        $('#Exito').modal('hide')
                    }, 2000); // abrir
                    // ServiciosCarga();
                } else if (dataResult.statusCode == 201) {
                    $("#submit_registro").html("Algo no salió bien... <i class='fas fa-exclamation-triangle'></i>");
                    $('#ErrorData').modal('toggle');
                   
                    setTimeout(function () {
                        $("#submit_registro").html("Guardar <i class='fas fa-save'></i>");
                    }, 3000); // abrir
                }
            }
        });
        return false;
    }
});
