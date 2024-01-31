$(document).ready(function(){
    $('#especialidadext').on('change', function(){
        var especialidadextValue = $(this).val();

        if (especialidadextValue !== "") {
            $('#medicoext').prop('disabled', false);
            $('#medicoext').load('Consultas/ObtieneMedicoProgramacion.php?sucursalExt=' + especialidadextValue);
        } else {
            $('#medicoext').empty();
            $('<option value="">Selecciona un medicoext</option>').appendTo('#medicoext');
            $('#medicoext').prop('disabled', true);
        }
    });
});
