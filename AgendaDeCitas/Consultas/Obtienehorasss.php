<?php
	include("ConeSelectDinamico.php");
	$medico=intval($_REQUEST['fecha']);
	$medicos = $conn->prepare("SELECT ID_Horario,Horario_Disponibilidad,FK_Fecha FROM 
	Horarios_Citas_Sucursales WHERE ID_Horario NOT IN (SELECT Hora FROM AgendaCitas_EspecialistasSucursales) AND FK_Fecha='$medico'") or die(mysqli_error());
		echo '<option value = "">Selecciona una hora </option>';
		echo '<option value = "">Sin horas disponibles</option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Horario'].'">'.date('h:i A', strtotime(( $row['Horario_Disponibilidad']))).'</option>';
		}
?>