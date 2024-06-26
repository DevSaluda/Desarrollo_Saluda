$('document').ready(function($) {
    $.validator.addMethod("Sololetras", function(value, element) {
        return this.optional(element) || /[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
    $.validator.addMethod("Telefonico", function(value, element) {
        return this.optional(element) || /^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar numeros!");
    $.validator.addMethod("Correos", function(value, element) {
        return this.optional(element) || /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Ingresa un correo valido!");
    $.validator.addMethod("NEmpresa", function(value, element) {
        return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
    $.validator.addMethod("Problema", function(value, element) {
        return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");


    $("#Generamelostraspasos").validate({
        rules: {


            codbarras: {
                required: true,
            },


        },
        messages: {
            codbarras: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },




        },
        submitHandler: submitForm
    });
    // hide messages 


    function submitForm() {



        $.ajax({
            type: 'POST',
            url: "Consultas/TraspasoAlMomentoCedis.php",
            data: $('#Generamelostraspasos').serialize(),
            cache: false,
            beforeSend: function() {

                $("#submit_registro").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");


            },
            success: function() {



                $('#TraspasoCorrecto').modal('toggle');
                setTimeout(function() {
                    $('#TraspasoCorrecto').modal('hide')
                }, 2000); // abrir


                setTimeout(' window.location.href = "https://saludapos.com/AdminPOS/ListadoDeTraspasos"; ', 3000);

            },
            error: function() {
                $("#show_error").fadeIn();
            }
        });
        return false;
    }
});