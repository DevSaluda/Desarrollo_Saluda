<?php
	include("ConeSelectDinamico.php");
	$TipCred=intval($_REQUEST['tipocred']);
	$Promo = $conn->prepare("SELECT * FROM Promos_Credit_POS WHERE Estatus='Vigente' AND Fk_Tratamiento = '$TipCred'") or die(mysqli_error());
		echo '<option value = "">Selecciona un medico </option>';
	if($Promo->execute()){
		$a_result = $Promo->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Promo_Cred'].'">'.( $row['Nombre_Promo']).'</option>';
		}
?>