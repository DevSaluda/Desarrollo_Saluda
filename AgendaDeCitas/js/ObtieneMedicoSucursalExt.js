$(document).ready(function(){
    $('#especialidadext').on('change', function(){
        var especialidadextValue = $(this).val();

        if (especialidadextValue !== "") {
            $('#medicoext').prop('disabled', false);

            console.log("URL:", 'Consultas/ObtieneMedicoProgramacion.php?sucursalExt=' + especialidadextValue);

            $.ajax({
                url: 'Consultas/ObtieneMedicoProgramacion.php',
                type: 'GET',
                data: { sucursalExt: especialidadextValue },
                success: function(response) {
                    console.log("Respuesta:", response);
                    $('#medicoext').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            $('#medicoext').empty();
            $('<option value="">Selecciona un medicoext</option>').appendTo('#medicoext');
            $('#medicoext').prop('disabled', true);
        }
    });
});
