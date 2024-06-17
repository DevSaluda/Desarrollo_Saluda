<?php
	include("ConeSelectDinamico.php");
	$medico=intval($_REQUEST['medico']);
	$medicos = $conn->prepare("SELECT * FROM  Costos_Especialistas WHERE Estatus='Activo 'AND FK_Especialista = '$medico'") or die(mysqli_error());
		echo '<option value = "">Selecciona un costo </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Costo_Esp'].'">'.( $row['Costo_Especialista']).'</option>';
		}
?>