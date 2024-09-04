<?php
	include("ConeSelectDinamico.php");
	$medico=intval($_REQUEST['medico']);
	$medicos = $conn->prepare("SELECT * FROM Sucursales_especialistas WHERE Estatus_Sucursal='Activo' AND FK_Especialista = '$medico'") or die(mysqli_error());
		echo '<option value = "">Selecciona un medico </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Sucursal'].'">'.( $row['Nombre_Sucursal']).'</option>';
		}
?>