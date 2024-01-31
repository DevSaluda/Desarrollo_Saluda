$(document).ready(function(){
    $('#especialidadext').on('change', function(){
        var especialidadextValue = $(this).val();

        if (especialidadextValue !== "") {
            $('#medicoext').prop('disabled', false);

            $.get('Consultas/ObtieneMedicoProgramacion.php', { sucursalExt: especialidadextValue })
                .done(function(response) {
                    $('#medicoext').html(response);
                })
                .fail(function(xhr, status, error) {
                    console.error(xhr.responseText);
                });
        } else {
            $('#medicoext').empty();
            $('<option value="">Selecciona un medicoext</option>').appendTo('#medicoext');
            $('#medicoext').prop('disabled', true);
        }
    });
});
