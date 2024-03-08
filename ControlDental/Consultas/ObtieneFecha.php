<?php
	include("ConeSelectDinamico.php");
	$medico=intval($_REQUEST['medico']);
	$medicos = $conn->prepare("SELECT * FROM Fechas_Especialistas WHERE Estatus_fecha='Activo 'AND FK_Especialista = '$medico'") or die(mysqli_error());
		echo '<option value = "">Selecciona una fecha </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Fecha_Esp'].'">'.( $row['Fecha_Disponibilidad']).'</option>';
		}
?>