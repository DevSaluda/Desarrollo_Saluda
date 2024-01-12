<?php
	include("ConeSelectDinamico.php");
	$TipoPromo=intval($_REQUEST['promocionva']);
	$Promo = $conn->prepare("SELECT * FROM Promos_Credit_POS WHERE Estatus='Vigente' AND ID_Promo_Cred = '$TipoPromo'") or die(mysqli_error());
		echo '<option value = "">Selecciona una cantidad </option>';
	if($Promo->execute()){
		$a_result = $Promo->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['ID_Promo_Cred'].'">'.( $row['CantidadADescontar']).'</option>';
		}
?>