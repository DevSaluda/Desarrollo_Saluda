<?php
	
        include_once 'db_connection.php';
		$contador = count($_POST["LabCod"]);
		$ProContador=0;
		$query = "INSERT INTO Agenda_Labs (LabAgendado, Nombres_Apellidos, Num_Orden, Telefono, Fk_sucursal, Fecha, Agrego) VALUES ";
		$queryValue = "";
		for($i=0;$i<$contador;$i++) {
			if(!empty($_POST["LabCod"][$i])) {
				$ProContador++;
				if($queryValue!="") {
					$queryValue .= ",";
				}
				$queryValue .= "('" . $_POST["LabCod"][$i] . "','" . $_POST["NombrePaciente"][$i] . "','" . $_POST["NumOrde"][$i] . "','" . $_POST["Telefono"][$i] . "','" . $_POST["Sucursal"][$i] . "','" . $_POST["FechaCita"][$i] . "','" . $_POST["Agendo"][$i] . "')";
			}
		} 
		$sql = $query.$queryValue;
		if($ProContador!=0) {
		    $resultadocon = mysqli_query($conn, $sql);
			if(!empty($resultadocon)) $resultado = " <br><ul class='list-group' style='margin-top:15px;'>
   <li class='list-group-item'>Registro(s) Agregado Correctamente.</li></ul>";
		}
	
?>
