$('document').ready(function(){
    $('#sucursalvendedor').on('change', function(){
            if($('#sucursalvendedor').val() == ""){
                $('#vendedor').empty();
                $('<option value = "">Selecciona una vendedor</option>').appendTo('#vendedor');
                $('#vendedor').attr('disabled', 'disabled');
            }else{
                $('#vendedor').removeAttr('disabled', 'disabled');
                $('#vendedor').load('Consultas/Obtienevendedor.php?sucursalvendedor=' + $('#sucursalvendedor').val());
                          }
    });
});