$('document').ready(function(){
    $('#medico').on('change', function(){
            if($('#medico').val() == ""){
                $('#costo').empty();
                $('<option value = "">Elige una hora</option>').appendTo('#costo');
                $('#costo').attr('disabled', 'disabled');
            }else{
                $('#costo').removeAttr('disabled', 'disabled');
                $('#costo').load('Consultas/Obtienecosto.php?medico=' + $('#medico').val());
            }
    });
});