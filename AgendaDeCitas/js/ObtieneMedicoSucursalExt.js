$('document').ready(function(){
    $('#sucursalExt').on('change', function(){
        var especialidadValue = $('#sucursalExt').val();
        if(especialidadValue == ""){
            $('#medicoext').empty();
            $('<option value="">Selecciona un medicoext</option>').appendTo('#medicoext');
            $('#medicoext').attr('disabled', 'disabled');
        } else {
            $('#medicoext').removeAttr('disabled');
            // Usaremos $.ajax para mayor control y depuración
            $.ajax({
                type: 'GET',
                url: 'Consultas/ObtieneMedicoProgramacion.php',
                data: { sucursalExt: especialidadValue },
                success: function(response) {
                    $('#medicoext').html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX: " + status + " - " + error);
                }
            });
        }
    });
});
