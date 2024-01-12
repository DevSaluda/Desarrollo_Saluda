<?php
	include("ConeSelectDinamico.php");
	$medico=intval($_REQUEST['medico']);
	$medicos = $conn->prepare("SELECT * FROM  Costos_EspecialistasV2 WHERE Estatus='Vigente' AND FK_Especialista = '$medico'") or die(mysqli_error());
	
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Costo_Esp'].'">'.( $row['Costo_Especialista']).'</option>';
		}
?>