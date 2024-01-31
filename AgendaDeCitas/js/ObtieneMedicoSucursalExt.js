$(document).ready(function(){
    $('#especialidadext').on('change', function(){
        if ($('#especialidadext').val() == "") {
            $('#medicoext').empty();
            $('<option value="">Selecciona un medicoext</option>').appendTo('#medicoext');
            $('#medicoext').prop('disabled', true);
        } else {
            // Habilitar el elemento select
            $('#medicoext').prop('disabled', false);

            // Obtener el valor del elemento select
            var especialidadValue = $('#especialidadext').val();

            // Deshabilitar el elemento select nuevamente
            $('#medicoext').prop('disabled', true);

            // Llamar a la carga de datos con el valor obtenido
            $('#medicoext').load('Consultas/ObtieneMedicoProgramacion.php?sucursalExt=' + especialidadValue);
        }
    });
});
