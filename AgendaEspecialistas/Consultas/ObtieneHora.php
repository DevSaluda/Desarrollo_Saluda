<?php
	include("ConeSelectDinamico.php");
	$medico=intval($_REQUEST['fecha']);
	$medicos = $conn->prepare("SELECT ID_Horario,Horario_Disponibilidad,Estatus_Horario
	FROM Horarios_Citas_especialistasV2
	WHERE Estatus_Horario='Vigente' and ID_Horario NOT IN
	  (SELECT Fk_Hora FROM AgendaCitas_EspecialistasV3) AND Fk_Fecha = '$medico'") or die(mysqli_error());
		echo '<option value = "">Selecciona una hora </option>';
		echo '<option value = "">Sin horas disponibles</option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Horario'].'">'.date('h:i A', strtotime(( $row['Horario_Disponibilidad']))).'</option>';
		}
?>