<?php
	include("ConeSelectDinamico.php");
	$id_departamento=intval($_REQUEST['id_deparatamento']);
	$municipios = $conn->prepare("SELECT * FROM Tipos_estudios WHERE Fk_Tipo_analisis = '$id_departamento'") or die(mysqli_error());
		echo '<option value = "">Selecciona un estudio  </option>';
	if($municipios->execute()){
		$a_result = $municipios->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_tipo_analisis'].'">'.( $row['Nombre_estudio']).'</option>';
		}
?>