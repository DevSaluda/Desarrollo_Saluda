$('document').ready(function(){
    $('#especialidadExt').on('change', function(){
            if($('#especialidadExt').val() == ""){
                $('#medicoExt').empty();
                $('<option value = "">Selecciona un medico</option>').appendTo('#medicoExt');
                $('#medicoExt').attr('disabled', 'disabled');
            }else{
                $('#medicoExt').removeAttr('disabled', 'disabled');
                $('#medicoExt').load('Consultas/ObtieneunmemedicoExt.php?especialidadExt=' + $('#especialidadExt').val());
                
            }
    });
});