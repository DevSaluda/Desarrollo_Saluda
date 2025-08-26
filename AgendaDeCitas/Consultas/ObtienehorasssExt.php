<?php
	include("ConeSelectDinamico.php");
	$medico=intval($_REQUEST['fechaExt']);
	
	// Agregar opción por defecto
	echo '<option value="">Selecciona una hora</option>';
	
	$medicos = $conn->prepare("SELECT ID_Horario, Horario_Disponibilidad, FK_Fecha FROM Horarios_Citas_Ext WHERE (Estado = 'Disponible' OR Estado = '' OR Estado IS NULL) AND FK_Fecha='$medico'") or die(mysqli_error());
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Horario'].'">'.date('h:i A', strtotime(( $row['Horario_Disponibilidad']))).'</option>';
		}
?>