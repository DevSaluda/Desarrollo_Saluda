<?php

if(!empty($_POST)){
	if(isset($_POST["ActualizaNombre"])){
		if($_POST["ActualizaNombre"]!=""){
			include "db_connection.php";
			
			$sql = "UPDATE Especialistas SET Nombre_Apellidos='$_POST[ActualizaNombre]',Especialidad='$_POST[ActualizaEspecialidad]',
            Tel='$_POST[ActualizaTel]', Estatus_Especialista='$_POST[Estatus]',CodigoColorEs='$_POST[Color]'where ID_Especialista=".$_POST["id"];
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