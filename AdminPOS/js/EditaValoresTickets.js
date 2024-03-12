$('document').ready(function ($) {
    $.validator.addMethod("Sololetras", function (value, element) {
        return this.optional(element) || /[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
    
    $.validator.addMethod("Telefonico", function (value, element) {
        return this.optional(element) || /^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar numeros!");
    
    $.validator.addMethod("Correos", function (value, element) {
        return this.optional(element) || /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Ingresa un correo valido!");
    
    $.validator.addMethod("NEmpresa", function (value, element) {
        return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
    
    $.validator.addMethod("Problema", function (value, element) {
        return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");

    $("#ActualizameLadatadelTicket").validate({
        rules: {
            codbarras: {
                required: true,
            }
        },
        messages: {
            codbarras: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            }
        },
        submitHandler: function () {
            // Aquí puedes realizar las acciones que desees antes de enviar el formulario, como validar campos o realizar otras tareas.
            // Luego, puedes enviar el formulario manualmente utilizando AJAX.
            $.ajax({
                type: 'POST',
                url: "Consultas/ActualizaLasFormasDePago.php",
                data: $('#ActualizameLadatadelTicket').serialize(), // Serializa los datos del formulario
                cache: false,
                beforeSend: function () {
                    // Realiza acciones antes del envío, como mostrar un mensaje de carga
                    $("#submit_registro").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
                },
                success: function () {
                    // Procesa la respuesta del servidor
                    $('#Exito').modal('toggle');
                    setTimeout(function () {
                        $('#Exito').modal('hide');
                    }, 2000); // abrir
                    CargaCitasEnSucursalExt();
                },
                error: function () {
                    // Acciones en caso de error de comunicación
                    $("#show_error").fadeIn();
                },
                complete: function () {
                    // Acciones después de que la solicitud se haya completado (éxito o error)
                }
            });
            return false;
        }
    });
});
