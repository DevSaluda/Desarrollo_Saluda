<?php
	include("ConeSelectDinamico.php");
	
	$medicos = $conn->prepare("SELECT * FROM  Especialidades_Express_Audita") or die(mysqli_error());
		echo '<option value = "">Selecciona una especialidad </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Especialidad'].'">'.( $row['Nombre_Especialidad']).'</option>';
		}
?>