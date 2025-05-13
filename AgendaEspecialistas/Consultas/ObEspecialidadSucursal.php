<?php
	include("ConeSelectDinamico.php");
	$medico=intval($_REQUEST['SucEs']);
	$medicos = $conn->prepare("SELECT * FROM Especialidades_Express WHERE  Fk_Sucursal = '$medico'") or die(mysqli_error());
		echo '<option value = "">Selecciona un medico </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Especialidad'].'">'.( $row['Nombre_Especialidad']).'</option>';
		}
?>