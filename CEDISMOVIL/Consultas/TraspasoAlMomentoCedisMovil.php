<?php
	
        include_once 'db_connection.php';
		$contador = count($_POST["Idprod"]);
		$ProContador=0;
		$query = "INSERT INTO Traspasos_generados ( Folio_Prod_Stock, ID_Prod_POS, Num_Orden,Num_Factura,Cod_Barra, Nombre_Prod, Fk_sucursal, Fk_Sucursal_Destino, Fk_SucDestino ,Precio_Venta, Precio_Compra, 
		Total_traspaso,TotalVenta, Existencias_R, Cantidad_Enviada, Existencias_D_envio, FechaEntrega,  TraspasoGeneradoPor, TraspasoRecibidoPor, Tipo_Servicio, 
		Proveedor1, Proveedor2,ProveedorFijo,Estatus,AgregadoPor, ID_H_O_D,TotaldePiezas) VALUES ";
		$queryValue = "";
		for($i=0;$i<$contador;$i++) {
			if(!empty($_POST["Idprod"][$i]) || !empty($_POST["CodBarra"][$i]) || !empty($_POST["NombreProducto"][$i])) {
				$ProContador++;
				if($queryValue!="") {
					$queryValue .= ",";
				}
				$queryValue .= "('" . $_POST["Idprod"][$i] . "','" . $_POST["Idprod"][$i] . "','" . $_POST["NumeroDelTraspaso"][$i] . "','" . $_POST["NumeroDeFacturaTraspaso"][$i] . "','" . $_POST["CodBarra"][$i] . "','" . $_POST["NombreProducto"][$i] . "','" . $_POST["SucursalTraspasa"][$i] . "','" . $_POST["SucursalDestinoLetras"][$i] . "','" . $_POST["SucursalDestino"][$i] . "','" . $_POST["PrecioVenta"][$i] . "','" . $_POST["PrecioDeCompra"][$i] . "','" . $_POST["resultadocompras"][$i] . "','" . $_POST["resultadoventas"][$i] . "',
				'" . $_POST["Existencia1"][$i] . "','" . $_POST["NTraspasos"][$i] . "','" . $_POST["Existencia2"][$i] . "','" . $_POST["FechaAprox"][$i] . "','" . $_POST["GeneradoPor"][$i] . "','" . $_POST["Recibio"][$i] . "','" . $_POST["TipodeServicio"][$i] . "','" . $_POST["Proveedor1"][$i] . "','" . $_POST["Proveedor2"][$i] . "','" . $_POST["ProveedorDelTraspaso"][$i] . "','" . $_POST["Estatus"][$i] . "','" . $_POST["GeneradoPor"][$i] . "','" . $_POST["Empresa"][$i] . "','" . $_POST["resultadepiezas"][$i] . "')";
			}
		} 
		$sql = $query.$queryValue;
		if($ProContador!=0) {
		    $resultadocon = mysqli_query($conn, $sql);
			if(!empty($resultadocon)) $resultado = " <br><ul class='list-group' style='margin-top:15px;'>
   <li class='list-group-item'>Registro(s) Agregado Correctamente.</li></ul>";
		}
	
?>
