<?php
	include("ConeSelectDinamico.php");
	$sucursal=intval($_REQUEST['sucursal']);
	$medicos = $conn->prepare("SELECT Personal_Medico.Fk_Usuario,Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos,Personal_Medico.Fk_Sucursal,Personal_Medico.Estatus,
	Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol FROM Personal_Medico,Roles_Puestos where Personal_Medico.Fk_Usuario=Roles_Puestos.ID_rol AND
	Personal_Medico.Estatus='Vigente'AND Personal_Medico.Fk_Sucursal = '$sucursal'  GROUP BY Personal_Medico.Fk_Usuario") or die(mysqli_error());
		echo '<option value = "">Selecciona un servicio  </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['Fk_Usuario'].'">'.( $row['Nombre_rol']).'</option>';
		}
?>