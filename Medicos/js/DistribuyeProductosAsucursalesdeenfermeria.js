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


    $("#ReasignaProductos").validate({
        rules: {
            Clav: {

                minlength: 5,
                maxlength: 15,
            },
            NombreProd: {
                required: true,
                minlength: 6,
                maxlength: 130,
            },
            Sucursal: {
                required: true,
            },
            PV: {
                required: true,
            },
            PC: {
                required: true,
            },
            MinE: {
                required: true,
            },
            MaxE: {
                required: true,
            },
            Tip: {
                required: true,
            },
            Categoria: {
                required: true,
            },
            Marca: {
                required: true,
            },
            Presentacion: {
                required: true,
            },
            Provee1: {
                required: true,
            },
        },
        messages: {

            Clav: {

                maxlength: "No puedes ingresar mas de 5 caracteres",
                minlength: "Debes ingresar minimo 3 caracteres"

            },
            NombreProd: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
                maxlength: "No puedes ingresar mas de 5 caracteres",
                minlength: "Debes ingresar minimo 3 caracteres"
            },
            Sucursal: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
            PV: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
            PC: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
            MinE: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
            MaxE: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
            Tip: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
            Categoria: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
            Marca: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
            Presentacion: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },
            Provee1: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },

        },
        submitHandler: submitForm
    });
    // hide messages 


    function submitForm() {



        $.ajax({
            type: 'POST',
            url: "Consultas/DistribuyeEnSucursalesEnfermeria.php",
            data: $('#ReasignaProductos').serialize(),
            cache: false,
            beforeSend: function() {

                $("#submit_registro").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");


            },
            success: function() {



                $('#ProcesandoInfo').modal('toggle');
                setTimeout(function() {
                    $('#ProcesandoInfo').modal('hide');
                }, 2000); // abrir
                setTimeout(function() {
                    $('#Distribucioncorrecta').modal('toggle');
                }, 3000); // abrir



            },
            error: function() {
                $("#show_error").fadeIn();
            }
        });
        return false;
    }
});