<?php
	include("ConeSelectDinamico.php");
	$sucursal=intval($_REQUEST['sucursalvendedor']);
	$medicos = $conn->prepare("SELECT * FROM PersonalPOS WHERE Estatus='Vigente' AND Fk_Sucursal = '$sucursal'") or die(mysqli_error());
		echo '<option value = "">Selecciona un vendedor </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['Nombre_Apellidos'].'">'.( $row['Nombre_Apellidos']).'</option>';
		}
?>