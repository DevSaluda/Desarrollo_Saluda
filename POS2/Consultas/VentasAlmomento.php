<?php
	
        include_once 'db_connection.php';
		$contador = count($_POST["pro_FKID"]);
		$ProContador=0;
		$query = "INSERT INTO Ventas_POS (ID_Prod_POS,Identificador_tipo,Turno,FolioSucursal,Folio_Ticket,Clave_adicional,Cod_Barra,Nombre_Prod,Cantidad_Venta,
        Fk_sucursal,Total_Venta,Importe,Total_VentaG,DescuentoAplicado,FormaDePago,CantidadPago,Cambio,Cliente,Fecha_venta,Fk_Caja,Lote,Sistema,AgregadoPor,ID_H_O_D,FolioSignoVital,TicketAnterior) VALUES ";
		$queryValue = "";
		for($i=0;$i<$contador;$i++) {
			if(!empty($_POST["pro_FKID"][$i]) || !empty($_POST["IdentificadorTip"][$i]) || !empty($_POST["TicketVal"])) {
				$ProContador++;
				if($queryValue!="") {
					$queryValue .= ",";
				}
				$queryValue .= "('" . $_POST["pro_FKID"][$i] . "','" . $_POST["IdentificadorTip"][$i] . "','" . $_POST["TurnoCaja"][$i] . "','" . $_POST["TicketSucursalName"] . "','" . $_POST["TicketVal"] . "','" .$_POST["pro_clavad"][$i] ."',
                '" . $_POST["CodBarras"][$i] . "','" . $_POST["NombreProd"][$i] . "','" . $_POST["CantidadTotal"][$i] . "','" . $_POST["Sucursaleventas"][$i] . "','" . $_POST["pro_cantidad"][$i] . "',
				'" . $_POST["ImporteT"][$i] . "','" . $_POST["TotalVentas"][$i] . "','" . $_POST["DescuentoAplicado"][$i] . "','" . $_POST["FormaPago"][$i] . "','" . $_POST["PagoReal"][$i] . "','" . $_POST["Cambio"][$i] . "','" . $_POST["cliente"][$i] . "','" . $_POST["Fecha"][$i] . "','" . $_POST["CajaSucursal"][$i] . "','" . $_POST["pro_lote"][$i] . "','" . $_POST["Sistema"][$i] . "','" . $_POST["Vendedor"][$i] . "','" . $_POST["Empresa"][$i] . "','" . $_POST["foliosv"][$i] . "','" . $_POST["ticketant"][$i] . "')";
			}
		}
		$sql = $query.$queryValue;
		if($ProContador!=0) {
		    $resultadocon = mysqli_query($conn, $sql);
			if(!empty($resultadocon)) $resultado = " <br><ul class='list-group' style='margin-top:15px;'>
   <li class='list-group-item'>Registro(s) Agregado Correctamente.</li></ul>";
		}
	
?>
