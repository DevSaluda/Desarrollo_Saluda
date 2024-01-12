$('document').ready(function(){
    $('#sucursalf').on('change', function(){
            if($('#sucursalf').val() == ""){
                $('#especialidadf').empty();
                $('<option value = "">Selecciona una especialidad</option>').appendTo('#especialidadf');
                $('#especialidadf').attr('disabled', 'disabled');
            }else{
                $('#especialidadf').removeAttr('disabled', 'disabled');
                $('#especialidadf').load('Consultas/ObtieneEspecialidadF.php?sucursal=' + $('#sucursalf').val());
                          }
    });
});