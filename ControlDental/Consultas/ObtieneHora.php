<?php
	include("ConeSelectDinamico.php");
	$medico=intval($_REQUEST['fecha']);
	$medicos = $conn->prepare("SELECT ID_Horario,Horario_Disponibilidad,Estatus_Horario
	FROM Horarios_Citas_especialistas
	WHERE Estatus_Horario='Activo' and ID_Horario NOT IN
	  (SELECT Fk_Hora FROM AgendaCitas_Especialistas ) AND FK_Especialista = '$medico'") or die(mysqli_error());
		echo '<option value = "">Selecciona una hora </option>';
		echo '<option value = "">Sin horas disponibles</option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Horario'].'">'.( $row['Horario_Disponibilidad']).'</option>';
		}
?>