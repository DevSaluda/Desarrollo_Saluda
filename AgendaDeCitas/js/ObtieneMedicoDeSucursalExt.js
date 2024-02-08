$('document').ready(function(){
    $('#especialidadExt').on('change', function(){
            if($('#especialidadExt').val() == ""){
                $('#medicoext').empty();
                $('<option value = "">Selecciona un medico</option>').appendTo('#medicoext');
                $('#medicoext').attr('disabled', 'disabled');
            }else{
                $('#medicoext').removeAttr('disabled', 'disabled');
                $('#medicoext').load('Consultas/Obtieneunmemedicoext.php?especialidadExt=' + $('#especialidadExt').val());
                
            }
    });
});