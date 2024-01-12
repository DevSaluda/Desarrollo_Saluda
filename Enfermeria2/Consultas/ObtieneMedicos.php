<?php
	include("ConeSelectDinamico.php");
	$sucursal=intval($_REQUEST['especialidad']);
	$medicos = $conn->prepare("SELECT * FROM EspecialistasV2 WHERE Estatus_Especialista='Vigente' AND Especialidad = '$sucursal'") or die(mysqli_error());
		echo '<option value = "">Selecciona un medico </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Especialista'].'">'.( $row['Nombre_Apellidos']).'</option>';
		}
?>