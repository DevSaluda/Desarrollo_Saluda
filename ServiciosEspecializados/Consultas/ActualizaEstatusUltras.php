<?php

if(!empty($_POST)){
	if(isset($_POST["ActualizaNombre"])){
		if($_POST["ActualizaNombre"]!=""){
			include "db_connection.php";
			
			$sql = "UPDATE Resultados_Ultrasonidos SET Nombre_paciente='$_POST[ActualizaNombre]',
            Telefono='$_POST[ActualizaTelefono]',ID_Sucursal='$_POST[ActualizaSucursal]',
             Estatus='$_POST[ActualizaEstatus]',Codigo_color='$_POST[ActualizaColor]' where ID_resultado=".$_POST["id"];

            
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