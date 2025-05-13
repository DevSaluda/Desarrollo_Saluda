<?php

if(!empty($_POST)){
			include "db_connection.php";
			
			$sql = "DELETE FROM Horarios_Citas_especialistas WHERE ID_Horario=".$_POST["id"];
			$query = $conn->query($sql);
			if($query!=null){   
				print "<script>alert(\"Eliminado exitosamente.\");window.location='../ver.php';</script>";
			}else{
				print "<script>alert(\"No se pudo eliminar.\");window.location='../ver.php';</script>";

			}
}

?>