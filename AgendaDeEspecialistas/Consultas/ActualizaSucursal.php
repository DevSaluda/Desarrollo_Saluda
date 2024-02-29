<?php

if(!empty($_POST)){
	if(isset($_POST["Sucursal"])){
		if($_POST["Sucursal"]!=""){
			include "db_connection.php";
			
			$sql = "UPDATE Sucursales_especialistas SET Nombre_Sucursal='$_POST[Sucursal]',Estatus_Sucursal='$_POST[Estatus]',
			CodigoColorSu='$_POST[Color]' where ID_Sucursal=".$_POST["id"];
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