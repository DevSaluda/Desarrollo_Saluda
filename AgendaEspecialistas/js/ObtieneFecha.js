
  	$('document').ready(function(){
		$('#medico').on('change', function(){
				if($('#medico').val() == ""){
					$('#fecha').empty();
					$('<option value = "">Selecciona una fecha</option>').appendTo('#fecha');
					$('#fecha').attr('disabled', 'disabled');
				}else{
					$('#fecha').removeAttr('disabled', 'disabled');
					$('#fecha').load('Consultas/ObtieneFecha.php?medico=' + $('#medico').val());
				}
		});
  });