<?php
	include("ConeSelectDinamico.php");
	$especialidad = isset($_REQUEST['especialidadExt']) ? intval($_REQUEST['especialidadExt']) : 0;
	$sucursal = isset($_REQUEST['sucursalExt']) ? intval($_REQUEST['sucursalExt']) : 0;
	echo '<option value = "">Selecciona un medico </option>';
	if($especialidad && $sucursal) {
		$medicos = $conn->prepare("SELECT Medico_ID, Nombre_Apellidos FROM Personal_Medico_Express WHERE Estatus='Disponible' AND Especialidad_Express = ? AND Fk_Sucursal = ?") or die(mysqli_error());
		$medicos->bind_param('ii', $especialidad, $sucursal);
		if($medicos->execute()){
			$a_result = $medicos->get_result();
			while($row = $a_result->fetch_array()){
				echo '<option value = "'.$row['Medico_ID'].'">'.($row['Nombre_Apellidos']).'</option>';
			}
		}
	}
	//PRUEBA
?>