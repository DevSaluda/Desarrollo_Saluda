$('document').ready(function(){
    $('#especialidad').on('change', function(){
            if($('#especialidad').val() == ""){
                $('#medico').empty();
                $('<option value = "">Selecciona un medico</option>').appendTo('#medico');
                $('#medico').attr('disabled', 'disabled');
            }else{
                $('#medico').removeAttr('disabled', 'disabled');
                $('#medico').load('Consultas/Obtieneunmemedico.php?especialidad=' + $('#especialidad').val());
                
            }
    });
});