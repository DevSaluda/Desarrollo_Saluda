$('document').ready(function(){
    $('#especialidadext').on('change', function(){
            if($('#especialidadext').val() == ""){
                $('#medicoext').empty();
                $('<option value = "">Selecciona un medicoext</option>').appendTo('#medicoext');
                $('#medicoext').attr('disabled', 'disabled');
            }else{
                $('#medicoext').removeAttr('disabled', 'disabled');
                $('#medicoext').load('Consultas/ObtieneMedicoProgramacion.php?especialidadext=' + $('#especialidadext').val());
                
            }
    });
});
            