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

    $('#especialidadExt').on('change', function(){
        var especialidadValue = $('#especialidadExt option:selected').text();

        if(especialidadValue === ""){
            $('#tipoconsultaExt').empty().append('<option value="">Elige un tipo de consulta</option>').prop('disabled', true);
        } else {
            console.log('Consultas/ObtieneTiposConsulta.php?especialidadExt=' + encodeURIComponent(especialidadValue));

            $('#tipoconsultaExt')
                .prop('disabled', false)
                .load('Consultas/ObtieneTiposConsulta.php?especialidadExt=' + encodeURIComponent(especialidadValue), function(response, status, xhr) {
                    if (status === "error") {
                        console.error("Error al cargar tipos de consulta: " + xhr.status + " " + xhr.statusText);
                    } else {
                        console.log("Tipos de consulta cargados correctamente");
                    }
                });
        }
    });
});
