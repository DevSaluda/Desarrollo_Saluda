$('document').ready(function(){
    $('#sucursal').on('change', function(){
            if($('#sucursal').val() == ""){
                $('#especialidadext').empty();
                $('<option value = "">Selecciona un especialidadext</option>').appendTo('#especialidadext');
                $('#especialidadext').attr('disabled', 'disabled');
            }else{
                $('#especialidadext').removeAttr('disabled', 'disabled');
                $('#especialidadext').load('Consultas/ObtieneEspecialidadExt.php?sucursal=' + $('#sucursal').val());
                
            }
    });
});


