$('document').ready(function ($) {

    // hide messages 
    $("#error_ActCosto").hide();
    $("#show_message").hide();

    // on submit...
    $('#ActualizaHorario').submit(function (e) {

        e.preventDefault();


        //name required
      //name required
     
    
      var Costo = $("input#Costo").val();
      if (Costo == "0") {
          $("#error_ActCosto").fadeIn().text("Debes ingresar una cantidad.");
          $("input#Costo").focus();
          $("#error_ActCosto").fadeOut(4000);
          return false;
      }
      var Costo2 = $("input#Costo").val();
      if (Costo2 == "00") {
          $("#error_ActCosto").fadeIn().text("No puedes ingresar 0.");
          $("input#Costo").focus();
          $("#error_ActCosto").fadeOut(4000);
          return false;
      }
      var Costo3 = $("input#Costo").val();
      if (Costo3 == "000") {
          $("#error_ActCosto").fadeIn().text("No puedes ingresar 0.");
          $("input#Costo").focus();
          $("#error_ActCosto").fadeOut(4000);
          return false;
      }
      var Costo4 = $("input#Costo").val();
      if (Costo4 == "0000") {
          $("#error_ActCosto").fadeIn().text("No puedes ingresar 0.");
          $("input#Costo").focus();
          $("#error_ActCosto").fadeOut(4000);
          return false;
      }
      var Costo5 = $("input#Costo").val();
      if (Costo5 == "00000") {
          $("#error_ActCosto").fadeIn().text("No puedes ingresar 0.");
          $("input#Costo").focus();
          $("#error_ActCosto").fadeOut(4000);
          return false;
      }
        // email required

        // ajax
        $.ajax({
            type: "POST",
            url: "Consultas/ActualizaCosto.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function () {


                CargaCostosH();
                $('#editModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#ExitoActualiza').modal('toggle');
                setTimeout(function () {
                    $('#ExitoActualiza').modal('hide')
                }, 2000); // abrir
            },
            error: function () {
                $("#show_error").fadeIn();
            }
        });
    });

    return false;
});