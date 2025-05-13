$('document').ready(function(){
    $('#fecha').on('change', function(){
            if($('#fecha').val() == ""){
                $('#hora').empty();
                $('<option value = "">Elige una hora</option>').appendTo('#hora');
                $('#hora').attr('disabled', 'disabled');
            }else{
                $('#hora').removeAttr('disabled', 'disabled');
                $('#hora').load('Consultas/ObtieneHora.php?fecha=' + $('#fecha').val());
            }
    });
});