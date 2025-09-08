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


    $("#Filtrapormediodesucursalconajax").validate({
        rules: {

            Sucursal: {
                required: true,
            },
        },
        messages: {


            Sucursal: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
            },

        },
        submitHandler: submitForm
    });
    // hide messages 


    function submitForm() {



        $.ajax({
            type: 'POST',
            url: "Consultas/FiltrapormediodesucursalconajaxAjuste.php",
            data: $('#Filtrapormediodesucursalconajax').serialize(),
            cache: false,
            beforeSend: function() {

                $("#submit_registroarea").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
            },
            success: function(response) {

                $("#TableAjusteTickets").html(response);
                $("#submit_registroarea").html("Aplicar cambio de sucursal <i class='fas fa-exchange-alt'></i>");
                $('#FiltroPorSucursalesIngresos').modal('hide');
                $('#Filtrapormediodesucursalconajax')[0].reset();
                // Reinicializar DataTable si existe
                if ($.fn.DataTable) {
                    $('#tablaAjusteTickets').DataTable().destroy();
                    $('#tablaAjusteTickets').DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                        },
                        "order": [[0, "desc"]],
                        "pageLength": 25
                    });
                }
            },
            error: function() {
                $("#submit_registroarea").html("Aplicar cambio de sucursal <i class='fas fa-exchange-alt'></i>");
                alert("Error al procesar la solicitud");
            }
        });
        return false;
    }
});
