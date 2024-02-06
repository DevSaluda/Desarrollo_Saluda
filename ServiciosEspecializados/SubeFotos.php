<?php
	include('conn.php');
	
	foreach ($_FILES['upload']['name'] as $key => $name){
		
		$newFilename = time() . "_" . $name;
		move_uploaded_file($_FILES['upload']['tmp_name'][$key], 'upload/' . $newFilename);
		$location = 'upload/' . $newFilename;
		$Fk_Nombre_paciente = $_POST['Nombre']; 
		mysqli_query($conn,"insert into Fotografias (Fk_Nombre_paciente, location) values ('$Fk_Nombre_paciente','$location')");
	}
	
?>

