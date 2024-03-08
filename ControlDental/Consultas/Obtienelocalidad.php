<?php
	include("ConeSelectDinamico.php");
	$estado=intval($_REQUEST['municipio']);
	$medicos = $conn->prepare("SELECT * FROM Localidades WHERE Fk_Municipio = '$estado'") or die(mysqli_error());
		echo '<option value = "">Selecciona una localidad </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Localidad'].'">'.( $row['Nombre_Localidad']).'</option>';
		}
?>