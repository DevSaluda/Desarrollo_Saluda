<?php

if(!empty($_POST)){
	if(isset($_POST["EstatusPago"])){
		if($_POST["EstatusPago"]!=""){
			include "db_connection.php";
			
			$sql = "UPDATE AgendaCitas_Especialistas SET Color_Pago='$_POST[Colorpago]',Estatus_pago='$_POST[EstatusPago]'
            ,Estatus_cita='$_POST[EstatusCita]',ColorEstatusCita='$_POST[Colorcita]',Color_Seguimiento='$_POST[Colorseguimiento]',
			Estatus_Seguimiento='$_POST[Estatusseguimiento]',Observaciones='$_POST[Observaciones]' where ID_Agenda_Especialista=".$_POST["id"];
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