<?php
	include("ConeSelectDinamico.php");
	$sucursal=intval($_REQUEST['sucursal']);
	$medicos = $conn->prepare("SELECT * FROM Personal_Medico WHERE Estatus='Vigente' AND  Fk_Sucursal = '$sucursal'") or die(mysqli_error());
		echo '<option value = "">Selecciona un medico </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['Medico_ID'].'">'.( $row['Nombre_Apellidos']).'</option>';
		}
?>