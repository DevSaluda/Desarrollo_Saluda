$('document').ready(function ($) {

    // hide messages 
    $("#error_alta").hide();
    $("#show_message").hide();

    // on submit...
    $('#ajax-form').submit(function (e) {

        e.preventDefault();

        //name required
        var Especialidad = $("select#especialidad").val();
        if (Especialidad == "") {
            $("#error_alta").fadeIn().text("Debes elegir una especialidad");
            $("select#especialidad").focus();

            $("#error_alta").fadeOut(3000);
            return false;
        }
        //name required
        var Medico = $("select#medico").val();
        if (Medico == "") {
            $("#error_alta").fadeIn().text("Debes elegir un medico");
            $("select#medico").focus();

            $("#error_alta").fadeOut(3000);
            return false;
        }
        //name required
        var Sucursal = $("select#sucursal").val();
        if (Sucursal == "") {
            $("#error_alta").fadeIn().text("Debes elegir una sucursal");
            $("select#sucursal").focus();

            $("#error_alta").fadeOut(3000);
            return false;
        }



        // email required

        // ajax
        $.ajax({
            type: "POST",
            url: "Consultas/GuardaSucursalC.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function () {
                $('#ValidaSucursal').hide();
                CargaSucursalesC();

                $("#ajax-form")[0].reset();
              
                $("#AltaSucursal").removeClass("in");

                $(".modal-backdrop").remove();
                $("#AltaSucursal").hide();
                $('#Exito').modal('toggle');
                setTimeout(function () {
                    $('#Exito').modal('hide')
                }, 2000); // abrir

            },
            error: function () {
                $("#show_error").fadeIn();
            }
        });
    });

    return false;
});