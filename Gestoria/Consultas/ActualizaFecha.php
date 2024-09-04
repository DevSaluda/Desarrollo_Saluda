<?php

if(!empty($_POST)){
	if(isset($_POST["ActualizaFecha"])){
		if($_POST["ActualizaFecha"]!=""){
			include "db_connection.php";
			
			$sql = "UPDATE Fechas_Especialistas SET Fecha_Disponibilidad='$_POST[ActualizaFecha]',Estatus_fecha='$_POST[Estatus]',
			CodigoColorFe='$_POST[Color]' where ID_Fecha_Esp=".$_POST["id"];
			$query = $conn->query($sql);
			if($query!=null){
				print "<script>alert(\"Actualizado exitosamente.\");window.location='../ver.php';</script>";
			}else{
				print "<script>alert(\"No se pudo actualizar.\");window.location='../ver.php';</script>";

			}
		}
	}
}



?>