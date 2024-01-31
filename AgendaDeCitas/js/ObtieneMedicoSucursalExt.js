$(document).ready(function(){
    $('#especialidadext').on('change', function(){
        if ($('#especialidadext').val() == "") {
            $('#medicoext').empty();
            $('<option value="">Selecciona un medicoext</option>').appendTo('#medicoext');
            $('#medicoext').prop('disabled', true);
        } else {
            $('#medicoext').prop('disabled', false);
            var url = 'Consultas/ObtieneMedicoProgramacion.php?sucursalExt=' + $('#especialidadext').val();
            console.log('URL de solicitud:', url);
            $('#medicoext').load(url, function(response, status, xhr) {
                console.log('Respuesta del servidor:', response);
            });
        }
    });
});
