$('document').ready(function ($) {

    // hide messages 
    $("#error_costo").hide();
    $("#show_message").hide();

    // on submit...
    $('#ajax-form').submit(function (e) {

        e.preventDefault();

        //name required
        var Especialidad = $("select#especialidad").val();
        if (Especialidad == "") {
            $("#error_costo").fadeIn().text("Debes elegir una especialidad.");
            $("select#especialidad").focus();
            $("#error_costo").fadeOut(4000);
            return false;
        }

        var Medico = $("select#medico").val();
        if (Medico == "") {
            $("#error_costo").fadeIn().text("Debes elegir un medico.");
            $("select#medico").focus();
            $("#error_costo").fadeOut(4000);
            return false;
        }
        var Costo = $("input#costo").val();
        if (Costo == "0") {
            $("#error_costo").fadeIn().text("Debes ingresar una cantidad.");
            $("input#costo").focus();
            $("#error_costo").fadeOut(4000);
            return false;
        }
        var Costo2 = $("input#costo").val();
        if (Costo2 == "00") {
            $("#error_costo").fadeIn().text("No puedes ingresar 0.");
            $("input#costo").focus();
            $("#error_costo").fadeOut(4000);
            return false;
        }
        var Costo3 = $("input#costo").val();
        if (Costo3 == "000") {
            $("#error_costo").fadeIn().text("No puedes ingresar 0.");
            $("input#costo").focus();
            $("#error_costo").fadeOut(4000);
            return false;
        }
        var Costo4 = $("input#costo").val();
        if (Costo4 == "0000") {
            $("#error_costo").fadeIn().text("No puedes ingresar 0.");
            $("input#costo").focus();
            $("#error_costo").fadeOut(4000);
            return false;
        }
        var Costo5 = $("input#costo").val();
        if (Costo5 == "00000") {
            $("#error_costo").fadeIn().text("No puedes ingresar 0.");
            $("input#costo").focus();
            $("#error_costo").fadeOut(4000);
            return false;
        }




        // email required

        // ajax
        $.ajax({
            type: "POST",
            url: "Consultas/GuardaCostos.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function () {
                $("#ajax-form")[0].reset();
                CargaCostos();
                $("#AltaCosto").removeClass("in");
                $(".modal-backdrop").remove();
                $("#AltaCosto").hide();
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