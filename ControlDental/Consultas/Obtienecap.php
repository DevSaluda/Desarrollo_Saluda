<?php
	include("ConeSelectDinamico.php");
	$medico=intval($_REQUEST['tipocred']);
	$medicos = $conn->prepare("SELECT * FROM  Tipos_Credit_POS WHERE ID_Tip_Cred = '$medico'") or die(mysqli_error());
	echo '<option value = "">Selecciona un costo </option>';
	if($medicos->execute()){
		$a_result = $medicos->get_result();
	}
		while($row = $a_result->fetch_array()){
			
			echo '<option value = "'.$row['ID_Tip_Cred'].'">'.( $row['Costo']).'</option>';
		}
?>