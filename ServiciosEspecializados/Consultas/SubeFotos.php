<?php
	include('conn.php');
	
	foreach ($_FILES['upload']['name'] as $key => $name){
		$newFilename = time() . "_" . $name;
		move_uploaded_file($_FILES['upload']['tmp_name'][$key], 'upload/' . $newFilename);
		$location = 'upload/' . $newFilename;
		$Fk_Nombre_paciente = $_POST['Nombre']; 
		mysqli_query($conn,"insert into Fotografias (Fk_Nombre_paciente, location) values ('$Fk_Nombre_paciente','$location')");
	}

	// Actualizar el estatus en Resultados_Ultrasonidos para el paciente
	$estatus = isset($_POST['Estatus']) ? $_POST['Estatus'] : '';
error_log("Valor recibido en Estatus: '" . $estatus . "'");
if (!empty($estatus) && !empty($_POST['Nombre'])) {
    mysqli_query($conn, "UPDATE Resultados_Ultrasonidos SET Estatus='$estatus' WHERE Nombre_paciente='" . $_POST['Nombre'] . "'");
}

	echo json_encode(['success' => true, 'estatus' => $estatus]);
exit;
?>
