<?php

if(!empty($_POST)){
	if(isset($_POST["ActualizaEspecialidad"])){
		if($_POST["ActualizaEspecialidad"]!=""){
			include "db_connection.php";
			
			$sql = "UPDATE Especialidades SET Nombre_Especialidad='$_POST[ActualizaEspecialidad]',
			Estatus_Especialidad='$_POST[Estatus]',Codigocolor='$_POST[Color]'
			 where ID_Especialidad=".$_POST["id"];
			$query = $conn->query($sql);
			if($query!=null){
				echo "<script>alert(\"Actualizado exitosamente.\");</script>";
			}else{
				echo "<script>alert(\"No se pudo actualizar.\");</script>";

			}
		}
	}
}



?>