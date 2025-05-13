<?php

if(!empty($_POST)){
	if(isset($_POST["ActualizaCosto"])){
		if($_POST["ActualizaCosto"]!=""){
			include "db_connection.php";
			
			$sql = "UPDATE Costos_Especialistas SET Costo_Especialista='$_POST[ActualizaCosto]',UsuarioAnade='$_POST[Empleado]'
            ,Estatus='$_POST[Estatus]',Codigocolor='$_POST[Color]' where ID_Costo_Esp=".$_POST["id"];
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