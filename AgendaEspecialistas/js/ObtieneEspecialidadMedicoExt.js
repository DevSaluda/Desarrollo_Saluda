$(document).ready(function(){
    $('#sucursalExt').on('change', function(){
        var sucursalValue = $(this).val();

        if(sucursalValue === ""){
            $('#especialidadExt').empty().append('<option value="">Selecciona una especialidad</option>').prop('disabled', true);
        } else {
            console.log('Consultas/ObtieneMedExt.php?sucursalExt=' + sucursalValue);

            $('#especialidadExt')
                .prop('disabled', false)
                .load('Consultas/ObtieneMedExt.php?sucursalExt=' + sucursalValue);
        }
    });
});
