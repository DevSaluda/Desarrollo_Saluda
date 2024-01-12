<?php
	include("ConeSelectDinamico.php");
	$estado=intval($_REQUEST['estado']);
	$medicos = $conn->prepare("SELECT * FROM Municipios WHERE Fk_Estado = '$estado'") or die(mysqli_error());
		echo '<option value = "">Selecciona un costo </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Municipio'].'">'.( $row['Nombre_Municipio']).'</option>';
		}
?>