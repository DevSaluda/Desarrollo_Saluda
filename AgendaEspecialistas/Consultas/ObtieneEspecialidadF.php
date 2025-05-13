<?php
	include("ConeSelectDinamico.php");
	$sucursal=intval($_REQUEST['sucursal']);
	$medicos = $conn->prepare("SELECT * FROM  EspecialidadesV2 WHERE Estatus_Especialidad='Vigente' AND Fk_Sucursal = '$sucursal'") or die(mysqli_error());
		echo '<option value = "">Selecciona una especialidad </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Especialidad'].'">'.( $row['Nombre_Especialidad']).'</option>';
		}
?>