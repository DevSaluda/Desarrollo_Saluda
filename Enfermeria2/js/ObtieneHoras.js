$('document').ready(function(){
    $('#fecha').on('change', function(){
            if($('#fecha').val() == ""){
                $('#horas').empty();
                $('<option value = "">Selecciona un fecha</option>').appendTo('#horas');
                $('#horas').attr('disabled', 'disabled');
            }else{
                $('#horas').removeAttr('disabled', 'disabled');
                $('#horas').load('Consultas/Obtienehorasss.php?fecha=' + $('#fecha').val());
                
            }
    });
});



