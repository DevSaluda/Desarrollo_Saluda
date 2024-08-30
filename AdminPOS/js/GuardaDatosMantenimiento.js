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
    $("#RegistroMantenimientoForm").validate({
        rules: {
            tipoEquipo: {
                required: true,
            },
            Comentario: {
                required: true,
                Sololetras: true,
            },
            'imagenes[]': {
                required: true,
                extension: "jpg|jpeg|png|gif",
            }
        },
        messages: {
            tipoEquipo: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Seleccione un tipo de equipo",
            },
            Comentario: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Escriba un comentario",
            },
            'imagenes[]': {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Cargue al menos una imagen",
                extension: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo se permiten imágenes en formato jpg, jpeg, png o gif",
            }
        },
        submitHandler: submitForm
    });

    function submitForm() {
        $("#RegistroMantenimientoForm").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'https://saludapos.com/AdminPOS/Consultas/RegistroDeMantenimientoDiario.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#submit_Mantenimiento").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
                },
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);

                    if (dataResult.statusCode == 250) {
                        $("#submit_Mantenimiento").html("Algo no salió bien.. <i class='fas fa-exclamation-triangle'></i>");
                        $('#ErrorDupli').modal('toggle');
                        setTimeout(function() {
                            $("#submit_Mantenimiento").html("Guardar <i class='fas fa-save'></i>");
                        }, 3000);

                    } else if (dataResult.statusCode == 200) {
                        $("#submit_Mantenimiento").html("Enviado <i class='fas fa-check'></i>");
                        $("#RegistroMantenimientoForm")[0].reset();
                        $("#RegistroMantenimientoVentanaModal").modal('hide');
                        $('#Exito').modal('toggle');
                        setTimeout(function() {
                            $('#Exito').modal('hide');
                        }, 2000);
                        // Realiza cualquier otra acción que desees al enviar el formulario con éxito

                    } else if (dataResult.statusCode == 201) {
                        $("#submit_Mantenimiento").html("Algo no salió bien.. <i class='fas fa-exclamation-triangle'></i>");
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
