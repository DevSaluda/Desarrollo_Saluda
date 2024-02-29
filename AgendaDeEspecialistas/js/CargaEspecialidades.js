
  	$('document').ready(function(){
		$('#especialidad').on('change', function(){
            $('#especialidad').load('Consultas/Obtieneespecialidad.php').val();
		});
  });