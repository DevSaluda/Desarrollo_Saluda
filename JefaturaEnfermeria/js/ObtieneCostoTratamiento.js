$('document').ready(function(){
    $('#tipocred').on('change', function(){
            if($('#tipocred').val() == ""){
                $('#cap').empty();
                $('<option value = "">Elige un tratamiento</option>').appendTo('#cap');
                $('#cap').attr('disabled', 'disabled');
            }else{
                $('#cap').removeAttr('disabled', 'disabled');
                $('#cap').load('Consultas/Obtienecap.php?tipocred=' + $('#tipocred').val());
            }
    });
});