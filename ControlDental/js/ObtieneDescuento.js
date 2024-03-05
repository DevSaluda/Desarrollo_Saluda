$('document').ready(function(){
    $('#tipocred').on('change', function(){
            if($('#tipocred').val() == ""){
                $('#promocionva').empty();
                $('<option value = "">Selecciona un promocion</option>').appendTo('#promocionva');
                $('#promocionva').attr('disabled', 'disabled');
            }else{
                $('#promocionva').removeAttr('disabled', 'disabled');
                $('#promocionva').load('Consultas/Obtienepromocion.php?tipocred=' + $('#tipocred').val());
                
            }
    });
});

