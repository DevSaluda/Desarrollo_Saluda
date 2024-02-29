$('document').ready(function(){
    $('#especialidadf').on('change', function(){
            if($('#especialidadf').val() == ""){
                $('#medicof').empty();
                $('<option value = "">Selecciona un medico</option>').appendTo('#medicof');
                $('#medicof').attr('disabled', 'disabled');
            }else{
                $('#medicof').removeAttr('disabled', 'disabled');
                $('#medicof').load('Consultas/ObtieneMedicosF.php?especialidad=' + $('#especialidadf').val());
                
            }
    });
});