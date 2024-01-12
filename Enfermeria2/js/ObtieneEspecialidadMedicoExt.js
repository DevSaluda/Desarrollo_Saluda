$('document').ready(function(){
    $('#sucursalExt').on('change', function(){
            if($('#sucursalExt').val() == ""){
                $('#especialidadExt').empty();
                $('<option value = "">Selecciona un especialidadExt</option>').appendTo('#especialidadExt');
                $('#especialidadExt').attr('disabled', 'disabled');
            }else{
                $('#especialidadExt').removeAttr('disabled', 'disabled');
                $('#especialidadExt').load('Consultas/ObtieneMedExt.php?sucursalExt=' + $('#sucursalExt').val());
                
            }
    });
});


