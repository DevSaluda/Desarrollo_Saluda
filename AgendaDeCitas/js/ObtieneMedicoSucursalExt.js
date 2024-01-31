$('document').ready(function(){
    $('#especialidadext').on('change', function(){
        if ($('#especialidadext').val() == "") {
            $('#medicoext').empty();
            $('<option value="">Selecciona un medicoext</option>').appendTo('#medicoext');
            $('#medicoext').prop('disabled', true);
        } else {
            $('#medicoext').prop('disabled', false);
            $('#medicoext').load('Consultas/ObtieneMedicoProgramacion.php?sucursalExt=' + $('#especialidadext').val());
        }
    });
});
