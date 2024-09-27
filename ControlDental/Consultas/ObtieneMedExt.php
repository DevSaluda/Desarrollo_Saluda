<?php
	include("ConeSelectDinamico.php");
	$sucursal=intval($_REQUEST['sucursalExt']);
	$medicos = $conn->prepare("SELECT * FROM Especialidades_Express WHERE Estatus_Especialidad='Disponible' AND Fk_Sucursal = '$sucursal'") or die(mysqli_error());
		echo '<option value = "">Selecciona especialidad </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Especialidad'].'">'.( $row['Nombre_Especialidad']).'</option>';
		}
?>