<?php
	include("ConeSelectDinamico.php");
	$sucursal=intval($_REQUEST['sucursalvendedoroff']);
	$medicos = $conn->prepare("SELECT Pos_ID,Nombre_Apellidos,ID_H_O_D FROM PersonalPOS WHERE Estatus='Vigente' AND Fk_Usuario!= 16  AND Fk_Sucursal = '$sucursal'") or die(mysqli_error());
		echo '<option value = "">Selecciona una especialidad </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['Pos_ID'].'">'.( $row['Nombre_Apellidos']).'</option>';
		}
?>