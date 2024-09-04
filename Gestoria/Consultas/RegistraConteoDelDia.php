<?php
	
        include_once 'db_connection.php';
		$contador = count($_POST["CodBarra"]);
		$ProContador=0;
		$query = "INSERT INTO ConteosDiarios (Cod_Barra, Nombre_Producto,Fk_sucursal, Existencias_R, ExistenciaFisica, AgregadoPor) VALUES ";
		$queryValue = "";
		for($i=0;$i<$contador;$i++) {
			if(!empty($_POST["CodBarra"][$i]) || !empty($_POST["NombreProd"][$i])) {
				$ProContador++;
				if($queryValue!="") {
					$queryValue .= ",";
				}
				$queryValue .= "('" . $_POST["CodBarra"][$i] . "','" . $_POST["NombreProd"][$i] . "','" . $_POST["Sucursal"][$i] . "','" . $_POST["StockEnEseMomento"][$i] . "',
                '" . $_POST["StockFisico"][$i] . "','" . $_POST["Agrego"][$i] . "')";
			}
		}
		$sql = $query.$queryValue;
		if($ProContador!=0) {
		    $resultadocon = mysqli_query($conn, $sql);
			if(!empty($resultadocon)) $resultado = " <br><ul class='list-group' style='margin-top:15px;'>
   <li class='list-group-item'>Registro(s) Agregado Correctamente.</li></ul>";
		}
	
?>
