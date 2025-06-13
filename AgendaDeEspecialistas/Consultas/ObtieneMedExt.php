<?php
	include("ConeSelectDinamico.php");
	$sucursal=intval($_REQUEST['sucursalExt']);
	$especialidades = $conn->prepare("SELECT DISTINCT ee.ID_Especialidad, ee.Nombre_Especialidad FROM Especialidades_Express ee INNER JOIN Personal_Medico_Express pme ON ee.ID_Especialidad = pme.Especialidad_Express WHERE ee.Estatus_Especialidad='Disponible' AND pme.Estatus='Disponible' AND ee.Fk_Sucursal = ?") or die(mysqli_error());
	echo '<option value = "">Selecciona especialidad </option>';
	$especialidades->bind_param('i', $sucursal);
	if($especialidades->execute()){
		$a_result = $especialidades->get_result();
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Especialidad'].'">'.($row['Nombre_Especialidad']).'</option>';
		}
	}
?>