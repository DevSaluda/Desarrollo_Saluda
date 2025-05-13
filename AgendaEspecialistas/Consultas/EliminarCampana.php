<?php

if(!empty($_POST)){
			include "db_connection.php";
			
			$sql = "DELETE FROM  Campañas_Especialistas WHERE ID_Camp_Esp=".$_POST["id"];
			$query = $conn->query($sql);
			if($query!=null){   
				print "<script>alert(\"Eliminado exitosamente.\");window.location='../ver.php';</script>";
			}else{
				print "<script>alert(\"No se pudo eliminar.\");window.location='../ver.php';</script>";

			}
}

?>