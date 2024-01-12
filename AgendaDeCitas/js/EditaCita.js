$('document').ready(function ($) {

    // hide messages 
    $("#error_ActCosto").hide();
    $("#show_message").hide();

    // on submit...
    $('#Actualizacita').submit(function (e) {

        e.preventDefault();


        //name required
      //name required
     
    
     

        // ajax
        $.ajax({
            type: "POST",
            url: "Consultas/ActualizaCita.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function () {

                CargaCampanas();
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