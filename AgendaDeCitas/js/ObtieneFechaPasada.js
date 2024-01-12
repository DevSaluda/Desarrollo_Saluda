
  	$('document').ready(function(){
		$('#medicof').on('change', function(){
				if($('#medicof').val() == ""){
					$('#fechaf').empty();
					$('<option value = "">Selecciona una fecha</option>').appendTo('#fechaf');
					$('#fechaf').attr('disabled', 'disabled');
				}else{
					$('#fechaf').removeAttr('disabled', 'disabled');
					$('#fechaf').load('Consultas/ObtieneFechaF.php?medico=' + $('#medicof').val());
				}
		});
  });