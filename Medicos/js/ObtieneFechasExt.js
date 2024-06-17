$('document').ready(function(){
    $('#medicoExt').on('change', function(){
            if($('#medicoExt').val() == ""){
                $('#fechaExt').empty();
                $('<option value = "">Selecciona un medico</option>').appendTo('#fechaExt');
                $('#fechaExt').attr('disabled', 'disabled');
            }else{
                $('#fechaExt').removeAttr('disabled', 'disabled');
                $('#fechaExt').load('Consultas/ObtieneFechassExt.php?medicoExt=' + $('#medicoExt').val());
                
            }
    });
});



