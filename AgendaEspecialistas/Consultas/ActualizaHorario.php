<?php

if(!empty($_POST)){
	if(isset($_POST["ActualizarHorario"])){
		if($_POST["ActualizarHorario"]!=""){
			include "db_connection.php";
			
			$sql = "UPDATE Horarios_Citas_especialistas SET Horario_Disponibilidad='$_POST[ActualizarHorario]',
			Estatus_Horario='$_POST[Estatus]',CodigoColorHo='$_POST[Color]' where ID_Horario=".$_POST["id"];
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