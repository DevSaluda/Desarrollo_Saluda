<?php
	include("ConeSelectDinamico.php");
	$sucursal=intval($_REQUEST['sucursal']);
	$medicos = $conn->prepare("SELECT ID_Especialidad,Nombre_Especialidad,Fk_Sucursal FROM Especialidades_Express WHERE Fk_Sucursal = '$sucursal'") or die(mysqli_error());
		echo '<option value = "">Selecciona un especialidad  </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Especialidad'].'">'.( $row['Nombre_Especialidad']).'</option>';
		}
?>