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
        var especialidadText = $('#especialidadExt option:selected').text();

        if(especialidadText === "" || especialidadText === "Selecciona una especialidad"){
            $('#tipoconsultaExt').empty().append('<option value="">Elige un tipo de consulta</option>');
        } else {
            console.log('Consultas/ObtieneTiposConsulta.php?especialidadExt=' + encodeURIComponent(especialidadText));

            $.get('Consultas/ObtieneTiposConsulta.php?especialidadExt=' + encodeURIComponent(especialidadText), function(data) {
                var fixedOptions = `
                    <option value="">Elige un tipo de consulta</option>
                    <option value="primera_cita">Primera cita</option>
                    <option value="revaloracion">Revaloración</option>
                `;
                $('#tipoconsultaExt').html(fixedOptions).append(data).prop('disabled', false);
            }).fail(function(xhr, status, error) {
                console.error("Error al cargar tipos de consulta: " + xhr.status + " " + xhr.statusText);
            });
        }
    });
});
