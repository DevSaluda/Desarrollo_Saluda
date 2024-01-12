$('document').ready(function(){
    $('#medico').on('change', function(){
            if($('#medico').val() == ""){
                $('#fecha').empty();
                $('<option value = "">Selecciona un medico</option>').appendTo('#fecha');
                $('#fecha').attr('disabled', 'disabled');
            }else{
                $('#fecha').removeAttr('disabled', 'disabled');
                $('#fecha').load('Consultas/ObtieneFechass.php?medico=' + $('#medico').val());
                
            }
    });
});



